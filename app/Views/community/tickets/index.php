<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Support Tickets<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Support Tickets</h2>
                <?php if (session()->has('user_id')): ?>
                    <a href="/tickets/create" class="btn btn-primary float-end">Create New Ticket</a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if (empty($tickets)): ?>
                    <p class="text-muted">No tickets yet. <a href="/tickets/create">Create one</a></p>
                <?php else: ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tickets as $ticket): ?>
                                <tr>
                                    <td><?= $ticket->id ?></td>
                                    <td><?= $ticket->ticket_title ?></td>
                                    <td><span class="badge bg-<?= $ticket->ticket_status == 'Resolved' ? 'success' : 'warning' ?>"><?= $ticket->ticket_status ?></span></td>
                                    <td><?= date('d-m-Y', strtotime($ticket->created_at)) ?></td>
                                    <td>
                                        <a href="/tickets/<?= $ticket->id ?>" class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
