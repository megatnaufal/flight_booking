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
    /**
     * Settings method (Profile)
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function settings()
    {
        // Try getting identity from attribute, fallback to session
        $identity = $this->request->getAttribute('identity');
        $userSession = $this->request->getSession()->read('Auth');
        
        $id = null;
        if ($identity) {
            $id = $identity->getIdentifier();
        } elseif ($userSession) {
            $id = $userSession->id;
        }

        if (!$id) {
            $this->Flash->error(__('Please log in to access settings.'));
            return $this->redirect(['action' => 'login']);
        }

        $user = $this->Users->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                // Update session with new data
                $this->request->getSession()->write('Auth', $user);
                $this->Flash->success(__('Profile updated successfully.'));
                return $this->redirect(['action' => 'settings']);
            }
            $this->Flash->error(__('Could not update profile. Please try again.'));
        }
        
        $this->set(compact('user'));
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

    /**
     * Update Settings method
     *
     * @return \Cake\Http\Response|null|void Redirects to referer
     */
    public function updateSettings()
    {
        if ($this->request->is('post')) {
            $session = $this->request->getSession();
            $data = $this->request->getData();
            
            // Save settings to Session
            // Structure: App.settings.dark_mode, etc.
            if (!empty($data['language'])) {
                $session->write('App.settings.language', $data['language']);
            }
            if (!empty($data['currency'])) {
                $session->write('App.settings.currency', $data['currency']);
            }
            if (!empty($data['font_size'])) {
                $session->write('App.settings.font_size', $data['font_size']);
            }
            
            // Checkbox for dark_mode (sent as '1' if checked, missing if unchecked)
            $isDarkMode = !empty($data['dark_mode']);
            $session->write('App.settings.dark_mode', $isDarkMode);

            $this->Flash->success(__('Settings saved successfully.'));
        }

        return $this->redirect($this->referer());
    }
}
