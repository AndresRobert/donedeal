<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-04-09
 * Time: 16:03
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController
{

    public $components = array('Cookie');
    
    public function beforeFilter()
    {
        parent::beforeFilter();
        
        // Allow users to register and logout.
        $this->Auth->allow('logout', 'add', 'recover');
        
        // Setup Cookie
        $this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
        $this->Cookie->httpOnly = true;
        
        if (!$this->Auth->loggedIn() && $this->Cookie->read('dndltlgnhsh')) {
            $cookie = $this->Cookie->read('dndltlgnhsh');
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.username' => $cookie['username']
                )
            ));
            $user['User']['password'] = $cookie['password'];
            if ($user && !$this->Auth->login($user['User'])) {
                $this->redirect('/users/logout');
            }
        }
    }

    public function index()
    {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add()
    {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            $this->User->create();
            $this->request->data['regdate'] = date('Y-m-d m:i:s');
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function recover()
    {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            $user = $this->User->findByEmail($this->request->data['User']['email']);
            if (isset($user['User'])) {
                $recover_password = uniqid();
                $this->User->id = $user['User']['id'];
                $user['User']['password'] = $recover_password;
                if ($this->User->save($user))
                $Email = new CakeEmail();
                $Email->from(array('noreply@donedeal.cl' => 'DoneDeal'))
                    ->to($user['User']['email'])
                    ->subject('Password Reset')
                    ->send('Your new password is: ' . $recover_password);
                $this->Flash->success(__('New password has been send to your mail'));
                return $this->redirect(array('action' => 'login'));
            } else {
                $this->Flash->error(__('Email is not registered.'));
            }
        }
    }

    public function edit()
    {
        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'edit'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($this->Auth->user('id'));
            unset($this->request->data['User']['password']);
        }
    }

    public function password()
    {
        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'edit'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($this->Auth->user('id'));
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null)
    {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

    public function login()
    {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->User->id = $this->Auth->user('id');
                $this->Cookie->write('dndltlgnhsh', $this->request->data['User'], true, '1 month');
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
        if ($this->Auth->loggedIn()) {
            return $this->redirect($this->Auth->redirectUrl());
        }
    }

    public function logout()
    {
        $this->Cookie->delete('dndltlgnhsh');
        $this->User->id = $this->Auth->user('id');
        $this->User->save(['User' => ['autologin_hash' => '']]);
        return $this->redirect($this->Auth->logout());
    }

}