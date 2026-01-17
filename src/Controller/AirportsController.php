<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Airports Controller
 *
 * @property \App\Model\Table\AirportsTable $Airports
 */
class AirportsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Airports->find();
        $airports = $this->paginate($query);

        $this->set(compact('airports'));
    }

    /**
     * View method
     *
     * @param string|null $id Airport id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $airport = $this->Airports->get($id, contain: []);
        $visualId = $this->Airports->find()->where(['id <=' => $id])->count();
        $this->set(compact('airport', 'visualId'));
    }

    // ...

    public function edit($id = null)
    {
        $airport = $this->Airports->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $airport = $this->Airports->patchEntity($airport, $this->request->getData());
            if ($this->Airports->save($airport)) {
                $this->Flash->success(__('The airport has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The airport could not be saved. Please, try again.'));
        }
        $visualId = $this->Airports->find()->where(['id <=' => $id])->count();
        $this->set(compact('airport', 'visualId'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $airport = $this->Airports->newEmptyEntity();
        if ($this->request->is('post')) {
            $airport = $this->Airports->patchEntity($airport, $this->request->getData());
            if ($this->Airports->save($airport)) {
                $this->Flash->success(__('The airport has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The airport could not be saved. Please, try again.'));
        }
        $this->set(compact('airport'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Airport id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    /**
     * Delete method
     *
     * @param string|null $id Airport id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $airport = $this->Airports->get($id);
        if ($this->Airports->delete($airport)) {
            $this->Flash->success(__('The airport has been deleted.'));
        } else {
            $this->Flash->error(__('The airport could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
