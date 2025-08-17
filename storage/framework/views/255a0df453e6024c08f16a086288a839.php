<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearance Requests</title>
    <style>
        .container {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: left;
            margin-bottom: 20px;
        }

        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-bar input[type="text"] {
            padding: 10px;
            width: 300px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .filter-select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-left: 10px;
        }

        .student-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .student-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #eee;
            padding: 15px;
            border-radius: 15px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .student-info {
            display: flex;
            align-items: center;
        }

        .student-avatar {
            margin-right: 15px;
        }

        .avatar-placeholder {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #007bff;
        }

        .student-details {
            font-size: 14px;
            color: #333;
        }

        .student-details h3 {
            font-size: 16px;
            margin: 0;
            margin-bottom: 5px;
            color: #007bff;
        }

        .status {
            font-size: 14px;
            font-weight: bold;
        }

        .status.approved {
            color: #27ae60;
        }

        .status.declined {
            color: #e74c3c;
        }

        .status.pending {
            color: #f39c12;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons button {
            padding: 5px 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .approve-btn {
            background-color: #27ae60;
            color: white;
        }

        .decline-btn {
            background-color: #e74c3c;
            color: white;
        }

        .disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<?php echo $__env->make('components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>
    <div class="container">
        <h2>Clearance Requests</h2>

        <div class="search-bar">
            <input type="text" id="search-name" placeholder="Search by name..." onkeyup="filterByName()">
            <select id="status-filter" class="filter-select" onchange="filterByStatus()">
                <option value="">Filter by status</option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Declined">Declined</option>
            </select>
        </div>

        <div class="student-list" id="student-list">
    <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="student-card" data-name="<?php echo e(strtolower($application->user->user_name ?? '')); ?>" data-status="<?php echo e(strtolower($application->applicationStatuses->last()->status ?? '')); ?>">
        <div class="student-info">
            
            <div class="student-details">
                <h3>Application ID: <?php echo e($application->id); ?></h3>
                <p>Name: <?php echo e($application->user->user_name ?? 'N/A'); ?></p>
                <p>Student ID: <?php echo e($application->student_id); ?></p>

                <!-- Loop through all application statuses -->
                <?php $__currentLoopData = $application->applicationStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p class="status 
                    <?php if($status->status == 'Pending'): ?> pending 
                    <?php elseif($status->status == 'Approved'): ?> approved 
                    <?php elseif($status->status == 'Declined'): ?> declined 
                    <?php endif; ?>">
                    Status: <?php echo e($status->status); ?> 
                </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="action-buttons">
            <form action="<?php echo e(route('updateStatus', $application->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <input type="hidden" name="status" value="Approved">
                <button type="submit" class="approve-btn <?php if($application->applicationStatuses->last()->status == 'Approved'): ?> disabled <?php endif; ?>" <?php if($application->applicationStatuses->last()->status == 'Approved'): ?> disabled <?php endif; ?>>Approve</button>
            </form>
            <form action="<?php echo e(route('updateStatus', $application->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <input type="hidden" name="status" value="Declined">
                <button type="submit" class="decline-btn <?php if($application->applicationStatuses->last()->status == 'Approved' || $application->applicationStatuses->last()->status == 'Declined'): ?> disabled <?php endif; ?>" <?php if($application->applicationStatuses->last()->status == 'Approved' || $application->applicationStatuses->last()->status == 'Declined'): ?> disabled <?php endif; ?>>Decline</button>
            </form>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
    </div>

    <script>
        function filterByName() {
            const searchValue = document.getElementById('search-name').value.toLowerCase();
            const studentCards = document.querySelectorAll('.student-card');

            studentCards.forEach(card => {
                const name = card.getAttribute('data-name');
                if (name.includes(searchValue)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function filterByStatus() {
            const statusFilter = document.getElementById('status-filter').value.toLowerCase();
            const studentCards = document.querySelectorAll('.student-card');

            studentCards.forEach(card => {
                const status = card.getAttribute('data-status');
                if (statusFilter === '' || status === statusFilter) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html><?php /**PATH C:\laragon\www\student-clearance-system\resources\views/clearance-requests.blade.php ENDPATH**/ ?>