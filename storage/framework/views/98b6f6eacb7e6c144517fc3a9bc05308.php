
<?php echo $__env->make('components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('dashboard-content'); ?>

<div class="container">
    <h1 class="dashboard-title">Student Dashboard</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">Submit Clearance Form</div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('student.submitClearanceForm')); ?>" onsubmit="disableSubmitButton(this)">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="reg_no">Registration Number</label>
                    <input type="text" name="reg_no" id="reg_no" class="form-control" value="<?php echo e($studentInfo->student_reg_no); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="faculty_name">Faculty Name</label>
                    <input type="text" id="faculty_name" class="form-control" value="<?php echo e($studentInfo->faculty->faculty_name); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="tel_no">Student type</label>
                    <input type="text" name="student_type" id="student_type" class="form-control" value="<?php echo e($studentInfo->student_type); ?>" readonly>
                </div>

                <button type="submit" class="btn btn-primary btn-block" id="submitButton" <?php echo e($application ? 'disabled' : ''); ?>>
                    <?php echo e($application ? 'Application Submitted' : 'Submit Clearance Form'); ?>

                </button>
            </form>
        </div>
    </div>

    <?php if($application): ?>
        <div class="card mt-4">
            <div class="card-header">Application Status by Department</div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $departmentStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($status->department->dep_name); ?></td>
                                <td class="
                                    <?php echo e($status->status === 'Pending' ? 'status-pending' : ''); ?>

                                    <?php echo e($status->status === 'Rejected' ? 'status-rejected' : ''); ?>

                                    <?php echo e($status->status === 'Approved' ? 'status-approved' : ''); ?>">
                                    <?php echo e($status->status === 'Hidden' ? 'Status Hidden' : $status->status); ?>

                                </td>
                                <td><?php echo e($status->reason); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    function disableSubmitButton(form) {
        form.querySelector('#submitButton').disabled = true;
        form.querySelector('#submitButton').textContent = 'Submitting...';
    }
</script>

<style>
/* Container Styling */
.container {
    max-width: 900px;
    margin: 0 auto;
    padding: 30px;
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

/* Dashboard Title Styling */
.dashboard-title {
    font-size: 2.5rem;
    color: #003366;
    text-align: center;
    margin-bottom: 30px;
    font-weight: 600;
}

/* Success Message Styling */
.alert-success {
    background: #dff0d8;
    color: #3c763d;
    border: 1px solid #3c763d;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 25px;
    text-align: center;
}

/* Card Styling */
.card {
    border: none;
    border-radius: 12px;
    background-color: #f8f9fa;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

/* Card Header Styling */
.card-header {
    background-color: #003366;
    color: #ffffff;
    padding: 20px;
    font-size: 1.5rem;
    font-weight: 600;
    text-align: center;
    border-radius: 12px 12px 0 0;
}

/* Card Body Styling */
.card-body {
    padding: 25px;
}

/* Form Group Styling */
.form-group {
    margin-bottom: 25px;
}

.form-group label {
    font-size: 1.1rem;
    color: #333333;
    margin-bottom: 10px;
    display: block;
    font-weight: 500;
}

.form-control {
    border-radius: 8px;
    padding: 12px;
    font-size: 1rem;
    border: 1px solid #ced4da;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #003366;
    box-shadow: 0 0 6px rgba(0, 51, 102, 0.25);
    outline: none;
}

/* Button Styling */
.btn-primary {
    background-color: #003366;
    border: none;
    padding: 12px 25px;
    font-size: 1.1rem;
    font-weight: 600;
    color: #ffffff;
    border-radius: 8px;
    transition: background-color 0.3s ease;
    width: 100%;
}

.btn-primary:hover {
    background-color: #002a4f;
    cursor: pointer;
}

.btn-primary:disabled {
    background-color: #6c757d;
    cursor: not-allowed;
}

/* Table Styling */
.table {
    margin-top: 20px;
    width: 100%;
    border-collapse: collapse;
}

.table thead {
    background-color: #003366;
    color: #ffffff;
}

.table thead th {
    font-size: 1.1rem;
    padding: 15px;
    text-align: left;
}

.table tbody td {
    font-size: 1rem;
    padding: 15px;
    border-bottom: 1px solid #dee2e6;
}

.table-hover tbody tr:hover {
    background-color: #f1f1f1;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}

/* Status Coloring */
.status-pending {
    color: #808080; /* Ash color for Pending */
}

.status-rejected {
    color: #dc3545; /* Red for Rejected */
}

.status-approved {
    color: #28a745; /* Green for Approved */
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\student-clearance-system\resources\views/student/dashboard.blade.php ENDPATH**/ ?>