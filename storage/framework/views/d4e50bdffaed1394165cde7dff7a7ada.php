
<!DOCTYPE html>
<html>
<head>
    <title>Import Users</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            width: 450px;
            text-align: center;
        }
        h1 {
            color: #495057;
            margin-bottom: 30px;
            font-size: 28px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        input[type="file"] {
            margin-bottom: 20px;
            padding: 10px;
            font-size: 14px;
            border: 2px solid #ced4da;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }
        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        #notification {
            display: none;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 14px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Import Users</h1>

        <div id="notification"></div>

        <form action="<?php echo e(route('users.import-form')); ?>" method="POST" enctype="multipart/form-data" onsubmit="return showNotification('success', 'Users imported successfully!')">
            <?php echo csrf_field(); ?>
            <input type="file" name="file" required>
            <button type="submit">Import Users</button>
        </form>

        <br>

        
    </div>

    <script>
        function showNotification(type, message) {
            var notification = document.getElementById('notification');
            notification.style.display = 'block';
            notification.style.backgroundColor = type === 'success' ? '#d1e7dd' : '#f8d7da';
            notification.style.color = type === 'success' ? '#0f5132' : '#842029';
            notification.innerHTML = message;
            setTimeout(function() {
                notification.style.display = 'none';
            }, 3000);
            return true;
        }
    </script>
</body>
</html><?php /**PATH C:\laragon\www\student-clearance-system\resources\views/import-users.blade.php ENDPATH**/ ?>