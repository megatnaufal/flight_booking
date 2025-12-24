<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Luggages Controller
 *
 * @property \App\Model\Table\LuggagesTable $Luggages
 */
class LuggagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Luggages->find()
            ->contain(['Bookings']);
        $luggages = $this->paginate($query);

        $this->set(compact('luggages'));
    }

    /**
     * View method
     *
     * @param string|null $id Luggage id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $luggage = $this->Luggages->get($id, contain: ['Bookings']);
        $this->set(compact('luggage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $luggage = $this->Luggages->newEmptyEntity();
        if ($this->request->is('post')) {
            $luggage = $this->Luggages->patchEntity($luggage, $this->request->getData());
            if ($this->Luggages->save($luggage)) {
                $this->Flash->success(__('The luggage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The luggage could not be saved. Please, try again.'));
        }
        $bookings = $this->Luggages->Bookings->find('list', limit: 200)->all();
        $this->set(compact('luggage', 'bookings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Luggage id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $luggage = $this->Luggages->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $luggage = $this->Luggages->patchEntity($luggage, $this->request->getData());
            if ($this->Luggages->save($luggage)) {
                $this->Flash->success(__('The luggage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The luggage could not be saved. Please, try again.'));
        }
        $bookings = $this->Luggages->Bookings->find('list', limit: 200)->all();
        $this->set(compact('luggage', 'bookings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Luggage id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $luggage = $this->Luggages->get($id);
        if ($this->Luggages->delete($luggage)) {
            $this->Flash->success(__('The luggage has been deleted.'));
        } else {
            $this->Flash->error(__('The luggage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
