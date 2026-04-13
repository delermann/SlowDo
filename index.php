<?php
// Chargement initial des tâches
$tasks = [];
try {
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query([], ['sort' => ['created_at' => -1]]);
    $cursor = $manager->executeQuery("slowdo_db.tasks", $query);
    $tasks = iterator_to_array($cursor);
} catch (Exception $e) {}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SlowDo - Ma Tout Doux List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.75); backdrop-filter: blur(12px); }
        
        /* Animation de sortie douce */
        .task-item { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .task-out { 
            opacity: 0; 
            transform: scale(0.9) translateX(30px); 
            filter: blur(4px);
        }
    </style>
</head>
<body class="bg-[#F0F4F3] min-h-screen flex justify-center p-4">

    <div class="w-full max-w-md glass rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-white min-h-[85vh] flex flex-col relative overflow-hidden">
        
        <header class="p-8 pt-12">
            <h1 class="text-3xl font-light text-slate-700 tracking-tight">Bonjour, <span class="font-semibold text-emerald-600">Alex</span>.</h1>
            <p class="text-slate-500 mt-2 text-sm italic italic">Prends une grande inspiration.</p>
        </header>

        <main id="task-container" class="flex-1 px-6 space-y-4 pb-28 overflow-y-auto">
           <?php foreach ($tasks as $task): 
    // On s'assure que les nouvelles propriétés existent (pour les anciennes tâches)
    $emoji = $task->emoji ?? '✨';
    $color = $task->color ?? '#10b981';
?>
    <div id="task-<?= $task->_id ?>" class="task-item bg-white/90 p-5 rounded-[2rem] shadow-sm border-l-8 flex items-center justify-between group" style="border-left-color: <?= $color ?>;">
        <div class="flex items-center gap-4">
            <div onclick="completeTask('<?= $task->_id ?>')" 
                 class="w-8 h-8 rounded-full border-2 border-slate-100 flex items-center justify-center cursor-pointer hover:border-emerald-400 transition-colors bg-white">
                <span class="text-sm"><?= $emoji ?></span>
            </div>
            <span class="text-slate-700 font-medium"><?= htmlspecialchars($task->title) ?></span>
        </div>
    </div>
<?php endforeach; ?>
        </main>

        <footer class="absolute bottom-0 left-0 right-0 p-8 flex justify-between items-center bg-gradient-to-t from-[#F0F4F3] via-[#F0F4F3]/80 to-transparent">
            <div class="flex gap-6 text-slate-400">
                <button class="hover:text-emerald-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </button>
            </div>
            
            <button onclick="addTask()" class="w-16 h-16 bg-emerald-500 text-white rounded-[2rem] shadow-lg shadow-emerald-200 flex items-center justify-center hover:bg-emerald-600 transition-all hover:rotate-90 active:scale-90">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            </button>
        </footer>
    </div>

    <script src="app.js"></script>
</body>
</html>