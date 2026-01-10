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
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
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
            // Authentication check would go here
            // For now, redirect to dashboard as a mockup
            return $this->redirect(['controller' => 'Dashboards', 'action' => 'admin']);
        }
    }

    /**
     * Settings method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function settings()
    {
        $identity = $this->request->getAttribute('identity');
        if (!$identity) {
            return $this->redirect(['action' => 'login']);
        }
        $user = $this->Users->get($identity->getIdentifier());

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            // specific non-column fields might be handled here if we were using a real DB with JSON columns,
            // but for now we just verify the flow.
            
            $this->Flash->success(__('Settings saved successfully.'));
            // In a real app: if ($this->Users->save($user)) ...
        }

        $currencies = ['MYR' => 'MYR (RM)', 'USD' => 'USD ($)', 'EUR' => 'EUR (€)', 'SGD' => 'SGD ($)'];
        $states = [
            'Johor' => 'Johor', 'Kedah' => 'Kedah', 'Kelantan' => 'Kelantan', 
            'Melaka' => 'Melaka', 'Negeri Sembilan' => 'Negeri Sembilan', 
            'Pahang' => 'Pahang', 'Penang' => 'Penang', 'Perak' => 'Perak', 
            'Perlis' => 'Perlis', 'Sabah' => 'Sabah', 'Sarawak' => 'Sarawak', 
            'Selangor' => 'Selangor', 'Terengganu' => 'Terengganu', 
            'Kuala Lumpur' => 'Kuala Lumpur', 'Labuan' => 'Labuan', 'Putrajaya' => 'Putrajaya'
        ];
        $languages = ['ms' => 'Bahasa Melayu', 'en' => 'English', 'zh' => 'Mandarin', 'ta' => 'Tamil'];
        $paymentMethods = [
            'grab' => 'GrabPay', 
            'tng' => 'Touch \'n Go eWallet', 
            'shopee' => 'ShopeePay', 
            'fpx' => 'FPX Online Banking', 
            'card' => 'Credit/Debit Card'
        ];

        $this->set(compact('user', 'currencies', 'states', 'languages', 'paymentMethods'));
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null|void Redirects to login
     */
    public function logout()
    {

        return $this->redirect(['action' => 'login']);
    }
}
