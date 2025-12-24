<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Passengers Controller
 *
 * @property \App\Model\Table\PassengersTable $Passengers
 */
class PassengersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Passengers->find()
            ->contain(['Users']);
        $passengers = $this->paginate($query);

        $this->set(compact('passengers'));
    }

    /**
     * View method
     *
     * @param string|null $id Passenger id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $passenger = $this->Passengers->get($id, contain: ['Users', 'Bookings']);
        $this->set(compact('passenger'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $passenger = $this->Passengers->newEmptyEntity();
        if ($this->request->is('post')) {
            $passenger = $this->Passengers->patchEntity($passenger, $this->request->getData());
            if ($this->Passengers->save($passenger)) {
                $this->Flash->success(__('The passenger has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The passenger could not be saved. Please, try again.'));
        }
        $users = $this->Passengers->Users->find('list', limit: 200)->all();
        $this->set(compact('passenger', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Passenger id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $passenger = $this->Passengers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $passenger = $this->Passengers->patchEntity($passenger, $this->request->getData());
            if ($this->Passengers->save($passenger)) {
                $this->Flash->success(__('The passenger has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The passenger could not be saved. Please, try again.'));
        }
        $users = $this->Passengers->Users->find('list', limit: 200)->all();
        $this->set(compact('passenger', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Passenger id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $passenger = $this->Passengers->get($id);
        if ($this->Passengers->delete($passenger)) {
            $this->Flash->success(__('The passenger has been deleted.'));
        } else {
            $this->Flash->error(__('The passenger could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
