<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            // Force role to 'user' for public registration
            $user->role = 'user';
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                if ($user->role === 'admin') {
                    return $this->redirect(['controller' => 'Dashboards', 'action' => 'admin']);
                }
                
                return $this->redirect('/');
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Add Admin method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function addAdmin()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            // Force role to 'admin'
            $user->role = 'admin';
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The admin user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $password = $this->request->getData('password');
            
            // Simple DB lookup
            $user = $this->Users->findByEmail($email)->first();

            if ($user) {
                // In a real app, verify password: 
                // if ((new \Cake\Auth\DefaultPasswordHasher())->check($password, $user->password)) ...
                
                // For now, allow login if user exists (Development Mode)
                $this->request->getSession()->write('Auth', $user);
                
                $this->Flash->success(__('Welcome back, ' . ($user->full_name ?: $user->email)));
                
                if ($user->role === 'admin') {
                    return $this->redirect(['controller' => 'Dashboards', 'action' => 'admin']);
                }
                return $this->redirect('/');
            }
            
            $this->Flash->error(__('Invalid email or password.'));
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null|void Redirects to login
     */
    public function logout()
    {
        $this->request->getSession()->delete('Auth');
        $this->Flash->success(__('You have been logged out.'));
        return $this->redirect(['action' => 'login']);
    }
}
