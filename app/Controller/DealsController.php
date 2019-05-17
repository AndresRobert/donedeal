<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-04-09
 * Time: 16:03
 */

App::uses('AppController', 'Controller');

class DealsController extends AppController
{
    public $uses = array('Deal', 'Statu');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function index($tab = 1)
    {
        $status = $this->Statu->find('all');
        $users_id = $this->Auth->user('id');
        foreach ($status as $status_id => $status_data) {
            $deals[$status_data['Statu']['id']] = $this->Deal->find('all', array(
                'conditions' => ['status_id' => $status_data['Statu']['id'], 'users_id' => $users_id],
                'order' => ['date' => 'desc'],
                'limit' => 20
            ));
        }
        $this->set('status', $status);
        $this->set('deals', $deals);
        $this->set('tab', $tab);
    }

    public function view($id = null)
    {
        $this->Deal->id = $id;
        if (!$this->Deal->exists()) {
            throw new NotFoundException(__('Invalid deal'));
        }
        $this->set('deal', $this->Deal->findById($id));
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $this->request->data['Deal']['users_id'] = $this->Auth->user('id');
            $this->Deal->create();
            $this->request->data['Deal']['date'] = $this->request->data['Deal']['date'] . ' ' . $this->request->data['Deal']['time'] . ':00';
            if ($this->Deal->save($this->request->data)) {
                $this->Flash->success(__('Deal added'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The deal could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null)
    {
        $this->Deal->id = $id;
        if (!$this->Deal->exists()) {
            throw new NotFoundException(__('Invalid deal'));
        }
        $deal = $this->Deal->findById($id);
        if ($deal['Deal']['users_id'] == $this->Auth->user('id')) {
            if ($deal['Deal']['status_id'] == 1) {
                if ($this->request->is('post') || $this->request->is('put')) {
                    if ($this->Deal->save($this->request->data)) {
                        $this->Flash->success(__('Deal saved'));
                        return $this->redirect(array('action' => 'index'));
                    }
                    $this->Flash->error(
                        __('The deal could not be saved. Please, try again.')
                    );
                } else {
                    $deal = $this->Deal->findById($id);
                    $this->set('deal', $deal);
                }
            } else {
                $this->Flash->error(__('Deal is done already'));
                return $this->redirect(array('action' => 'index'));
            }
        } else {
            $this->Flash->error(__('You are not the owner '));
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function delete($id = null)
    {
        $this->layout = 'loading';
        $this->request->allowMethod('get');
        $this->Deal->id = $id;
        if (!$this->Deal->exists()) {
            throw new NotFoundException(__('Invalid deal'));
        }
        $deal = $this->Deal->findById($id);
        if ($deal['Deal']['users_id'] == $this->Auth->user('id')) {
            if ($deal['Deal']['status_id'] == 1) {
                if ($this->Deal->delete()) {
                    $this->Flash->success(__('Deal deleted'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Flash->error(__('Deal was not deleted'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Deal is done already'));
                return $this->redirect(array('action' => 'index'));
            }
        } else {
            $this->Flash->error(__('You are not the owner'));
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function forward($id = null, $amount_paid = 0)
    {
        $this->layout = 'loading';
        $this->Deal->id = $id;
        if (!$this->Deal->exists()) {
            throw new NotFoundException(__('Invalid deal'));
        }
        $deal = $this->Deal->findById($id);
        if ($deal['Deal']['users_id'] == $this->Auth->user('id')) {
            if ($deal['Deal']['status_id'] < 3) {
                $deal['Deal']['status_id']++;
                $deal['Deal']['pay_date'] = date('Y-m-d H:i:m');
                $deal['Deal']['pay_amount'] = $amount_paid;
                if ($this->Deal->save($deal)) {
                    $this->Flash->success(__('Deal saved'));
                    return $this->redirect(array('action' => 'index/' . $deal['Deal']['status_id']));
                } else {
                    $this->Flash->error(
                        __('The deal could not be saved. Please, try again.')
                    );
                }
            } else {
                $this->Flash->error(__('Deal is done already'));
                return $this->redirect(array('action' => 'index'));
            }
        } else {
            $this->Flash->error(__('You are not the owner'));
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function back($id = null)
    {
        $this->layout = 'loading';
        $this->Deal->id = $id;
        if (!$this->Deal->exists()) {
            throw new NotFoundException(__('Invalid deal'));
        }
        $deal = $this->Deal->findById($id);
        if ($deal['Deal']['users_id'] == $this->Auth->user('id')) {
            if ($deal['Deal']['status_id'] > 1) {
                $deal['Deal']['status_id']--;
                if ($this->Deal->save($deal)) {
                    $this->Flash->success(__('Deal saved'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(
                        __('The deal could not be saved. Please, try again.')
                    );
                }
            } else {
                $this->Flash->error(__('Deal is done already'));
                return $this->redirect(array('action' => 'index/' . $deal['Deal']['status_id']));
            }
        } else {
            $this->Flash->error(__('You are not the owner'));
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function report()
    {
        $status = $this->Statu->find('all');
        $users_id = $this->Auth->user('id');
        $report = $labels = array();
        $total_paid = 0;
        foreach ($status as $status_id => $status_data) {
            $labels[$status_data['Statu']['id']] = $status_data['Statu']['name'];
            $deals[$status_data['Statu']['id']] = $this->Deal->find('all', array(
                'conditions' => ['status_id' => $status_data['Statu']['id'], 'users_id' => $users_id],
                'order' => ['date' => 'desc'],
                'limit' => 20
            ));
            $report['data'][$status_data['Statu']['id']] = count($deals[$status_data['Statu']['id']]);
            foreach ($deals as $deal) {
                foreach ($deal as $dea) {
                    $total_paid += $dea['Deal']['pay_amount'];
                }
            }
        }

        $labels = "'" . implode("','", $labels) . "'";
        $data = implode(",", $report['data']);
        $this->set('status', $status);
        $this->set('labels', $labels);
        $this->set('deals', $deals);
        $this->set('report', $report);
        $this->set('data', $data);
        $this->set('total_paid', $total_paid);
    }
}