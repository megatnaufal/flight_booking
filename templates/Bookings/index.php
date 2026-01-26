<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Booking> $bookings
 */
?>
<?= $this->element('admin_theme') ?>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back'), ['controller' => 'Dashboards', 'action' => 'index', '#' => 'bookings'], ['class' => 'btn btn-sm btn-outline-secondary', 'escape' => false]) ?>
            <h2 class="m-0">BOOKINGS</h2>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="table-responsive">
            <table class="table-flyhigh">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('passenger_id') ?></th>
                        <th><?= $this->Paginator->sort('flight_id') ?></th>
                        <th><?= $this->Paginator->sort('booking_date') ?></th>
                        <th><?= $this->Paginator->sort('seat_number') ?></th>
                        <th><?= $this->Paginator->sort('ticket_status') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $page = $this->Paginator->current('Bookings') ?: 1;
                    $limit = $this->Paginator->param('perPage') ?: 20;
                    $counter = ($page - 1) * $limit;
                    $direction = strtolower($this->Paginator->param('direction') ?? 'asc');
                    $totalCount = $this->Paginator->param('count');
                    ?>
                    <?php foreach ($bookings as $key => $booking): 
                        $rowId = ($direction === 'desc') ? $totalCount - ($counter + $key) : $counter + $key + 1;
                    ?>
                    <tr>
                        <td class="fw-bold text-muted"><?= $rowId ?></td>
                        <td><?= $booking->hasValue('passenger') ? $this->Html->link($booking->passenger->full_name, ['controller' => 'Passengers', 'action' => 'view', $booking->passenger->id], ['class' => 'text-decoration-none text-dark']) : '' ?></td>
                        <td><?= $booking->hasValue('flight') ? $this->Html->link($booking->flight->flight_number, ['controller' => 'Flights', 'action' => 'view', $booking->flight->id], ['class' => 'text-decoration-none text-primary']) : '' ?></td>
                        <td><?= h($booking->booking_date?->format('d M Y')) ?></td>
                        <td><?= h($booking->seat_number) ?></td>
                        <td>
                            <?php 
                                $status = strtolower($booking->ticket_status ?? ''); 
                                $isPaid = ($status == 'confirmed' || $status == 'paid');
                            ?>
                            <span class="status-badge <?= $isPaid ? 'status-paid' : 'status-unpaid' ?>">
                                <?= $isPaid ? 'Paid' : 'Pending Payment' ?>
                            </span>
                        </td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $booking->id], ['class' => 'text-primary me-2 text-decoration-none fw-bold']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $booking->id], ['class' => 'text-muted me-2 text-decoration-none']) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $booking->id],
                                [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $booking->id),
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