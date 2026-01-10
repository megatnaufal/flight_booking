<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSettings extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('settings');
        $table->addColumn('site_name', 'string', ['limit' => 255, 'default' => 'Airpaz Clone'])
              ->addColumn('contact_email', 'string', ['limit' => 255])
              ->addColumn('default_currency', 'string', ['limit' => 3, 'default' => 'MYR'])
              ->addColumn('booking_fee', 'decimal', ['precision' => 10, 'scale' => 2, 'default' => 0.00])
              ->addColumn('created', 'datetime', ['null' => true])
              ->addColumn('modified', 'datetime', ['null' => true])
              ->create();
    }
}
<?php
declare(strict_types=1);

namespace App\Controller;

class SettingsController extends AppController
{
    public function index()
    {
        // Fetch the first record or create a new empty entity
        $setting = $this->Settings->find()->first() ?: $this->Settings->newEmptyEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntity($setting, $this->request->getData());
            if ($this->Settings->save($setting)) {
                $this->Flash->success(__('The settings have been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to save settings. Please try again.'));
        }

        $this->set(compact('setting'));
    }
}
<?php
/** @var \App\View\AppView $this */
/** @var \App\Model\Entity\Setting $setting */
?>
<div class="settings index content">
    <div style="background: #007bff; color: white; padding: 20px; border-radius: 8px 8px 0 0;">
        <h3 style="margin: 0;"><?= __('Flight System Configuration') ?></h3>
    </div>
    
    <div style="background: white; padding: 30px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 8px 8px;">
        <?= $this->Form->create($setting) ?>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <?= $this->Form->control('site_name', [
                    'label' => 'Portal Name',
                    'class' => 'form-control',
                    'style' => 'width: 100%; padding: 8px; margin-bottom: 15px;'
                ]) ?>
                <?= $this->Form->control('contact_email', [
                    'label' => 'Support Email',
                    'class' => 'form-control',
                    'style' => 'width: 100%; padding: 8px;'
                ]) ?>
            </div>
            <div>
                <?= $this->Form->control('default_currency', [
                    'label' => 'Default Currency',
                    'options' => ['MYR' => 'MYR - Ringgit', 'USD' => 'USD - Dollar'],
                    'style' => 'width: 100%; padding: 8px; margin-bottom: 15px;'
                ]) ?>
                <?= $this->Form->control('booking_fee', [
                    'label' => 'Booking Fee (Amount)',
                    'style' => 'width: 100%; padding: 8px;'
                ]) ?>
            </div>
        </div>
        <hr style="margin: 25px 0;">
        <?= $this->Form->button(__('Save Configuration'), [
            'style' => 'background: #28a745; color: white; padding: 10px 25px; border: none; border-radius: 4px; cursor: pointer;'
        ]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>