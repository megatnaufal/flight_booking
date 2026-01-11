<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<?= $this->element('admin_theme') ?>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>SYSTEM USERS</h2>
        <div>
            <?= $this->Html->link(__('<i class="bi bi-shield-lock"></i> New Admin'), ['action' => 'addAdmin'], ['class' => 'btn-create me-2', 'escape' => false]) ?>
            <?= $this->Html->link(__('<i class="bi bi-plus-lg"></i> New User'), ['action' => 'add'], ['class' => 'btn-create', 'escape' => false]) ?>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="table-responsive">
            <table class="table-flyhigh">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('username') ?></th>
                        <th><?= $this->Paginator->sort('email') ?></th>
                        <th><?= $this->Paginator->sort('role') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                        <th><?= $this->Paginator->sort('modified') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="fw-bold text-muted"><?= $this->Number->format($user->id) ?></td>
                        <td style="font-weight: bold;"><i class="bi bi-person-circle me-2" style="color:#666;"></i><?= h($user->username) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td><span class="status-badge <?= strtolower($user->role) == 'admin' ? 'role-admin' : 'role-user' ?>"><?= h($user->role) ?></span></td>
                        <td style="font-size: 0.85rem; color: #666;"><?= h($user->created) ?></td>
                        <td style="font-size: 0.85rem; color: #666;"><?= h($user->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class' => 'text-primary me-2 text-decoration-none fw-bold']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'text-muted me-2 text-decoration-none']) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $user->id],
                                [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $user->id),
                                    'class' => 'text-danger text-decoration-none'
                                ]
                            ) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p class="text-muted small mt-2"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>
</main>
</div>