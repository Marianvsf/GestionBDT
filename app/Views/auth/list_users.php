<?php require __DIR__ . '/../layout/header.php'; ?>
<style>    
    .feature-card {
        border: 1px solid rgba(203, 213, 225, 0.6);
        background: linear-gradient(160deg, rgba(241, 245, 249, 0.55), rgba(248, 250, 252, 0.45));
        box-shadow: 0 20px 45px -30px rgba(30, 41, 59, 0.35);
    }
    @media (max-width: 768px) {
    .feature-card {
        background: none;
        box-shadow: none;
        border: none;
        }
    }
</style>
<div class="feature-card md:p-12 mt-16 rounded-3xl mx-16">
<h2 class="text-2xl text-center font-bold">Usuarios</h2>
<div class="container bg-white mx-auto px-12 py-8 mt-[50px] p-6 rounded-lg shadow my-auto">
    <div class="max-w-5xl mx-auto border-none rounded-lg mb-4">
        <div class="flex items-center justify-between mb-4">
                <a href="?route=create_user" class="text-sm text-right justify-end text-indigo-700 hover:underline">Crear usuario</a>
            </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    <div class="md:col-span-2">
                        <label for="userSearch" class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1">Buscar</label>
                        <input
                            id="userSearch"
                            type="text"
                            placeholder="ID o nombre de usuario"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        >
                    </div>
                    <div>
                        <label for="roleFilter" class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1">Rol</label>
                        <select
                            id="roleFilter"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        >
                            <option value="all">Todos</option>
                            <?php foreach ($roles as $roleOption): ?>
                                <option value="<?= htmlspecialchars($roleOption) ?>"><?= htmlspecialchars($roleOption) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="ownerFilter" class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1">Tipo</label>
                        <select
                            id="ownerFilter"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        >
                            <option value="all">Todos</option>
                            <option value="self">Mi usuario</option>
                            <option value="others">Otros usuarios</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-3">
                    <p id="usersCount" class="text-xs text-gray-500">Mostrando 0 de 0 usuarios</p>
                    <button
                        id="clearUserFilters"
                        type="button"
                        class="text-xs text-indigo-700 font-semibold hover:underline"
                    >
                        Limpiar filtros
                    </button>
                </div>
            </div>

        <div class="max-w-5xl mx-auto">
            <?php
                $roles = [];
                foreach ($users as $userItem) {
                    $roleValue = trim((string)($userItem['role'] ?? ''));
                    if ($roleValue !== '' && !in_array($roleValue, $roles, true)) {
                        $roles[] = $roleValue;
                    }
                }
                sort($roles, SORT_NATURAL | SORT_FLAG_CASE);
            ?>

            <?php if(isset($flashError)): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-md text-red-700 mb-4 text-sm">
                    <?= htmlspecialchars($flashError) ?>
                </div>
            <?php endif; ?>

            <?php if(isset($flashSuccess)): ?>
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-3 rounded-md text-emerald-700 mb-4 text-sm">
                    <?= htmlspecialchars($flashSuccess) ?>
                </div>
            <?php endif; ?>

            <?php
                $formatUserDate = function ($value) {
                    if (!is_string($value) || trim($value) === '') {
                        return 'No disponible';
                    }

                    $timestamp = strtotime($value);
                    if ($timestamp === false) {
                        return 'No disponible';
                    }

                    return date('d/m/Y H:i', $timestamp);
                };
            ?>

            

            <div class="overflow-x-auto border border-gray-300 rounded-lg">
                <table class="w-full text-left border-collapse overflow-hidden text-sm">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                            <th class="py-3 px-6">ID</th>
                            <th class="py-3 px-6">Usuario</th>
                            <th class="py-3 px-6">Rol</th>
                            <th class="py-3 px-6">Departamento</th>
                            <th class="py-3 px-6">Creado</th>
                            <th class="py-3 px-6">Actualizado</th>
                            <th class="py-3 px-6">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody" class="text-gray-600 text-sm font-light">
                        <?php foreach ($users as $user): ?>
                            <?php $isCurrentUser = intval($user['id']) === intval($_SESSION['user_id']); ?>
                            <?php $normalizedUsername = function_exists('mb_strtolower') ? mb_strtolower((string)$user['username'], 'UTF-8') : strtolower((string)$user['username']); ?>
                            <tr
                                class="border-b border-gray-200 hover:bg-gray-100"
                                data-user-id="<?= intval($user['id']) ?>"
                                data-username="<?= htmlspecialchars($normalizedUsername) ?>"
                                data-role="<?= htmlspecialchars((string)$user['role']) ?>"
                                data-is-self="<?= $isCurrentUser ? '1' : '0' ?>"
                            >
                                <td class="py-3 px-6"><?= $user['id'] ?></td>
                                <td class="py-3 px-6 font-semibold"><?= htmlspecialchars($user['username']) ?></td>
                                <td class="py-3 px-6"><?= htmlspecialchars($user['role']) ?></td>
                                <td class="py-3 px-6"><?= htmlspecialchars($user['department'] ?? 'No especificado') ?></td>
                                <td class="py-3 px-6"><?= htmlspecialchars($formatUserDate($user['created_at'] ?? null)) ?></td>
                                <td class="py-3 px-6"><?= htmlspecialchars($formatUserDate($user['updated_at'] ?? null)) ?></td>
                                <td class="py-3 px-6">
                                    <?php if ($isCurrentUser): ?>
                                        <span class="text-xs text-gray-400">Tu usuario</span>
                                    <?php else: ?>
                                        <div class="flex items-center gap-3">
                                            <a href="?route=edit_user&id=<?= $user['id'] ?>" class="text-sm text-indigo-700 hover:underline relative group">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>
                                                    <span class="pointer-events-none absolute -top-10 left-1/2 -translate-x-1/2 whitespace-nowrap rounded 
                                                    bg-blue-700 px-2 py-1 text-xs font-medium text-white opacity-0 transition-opacity group-hover:opacity-100 shadow-lg z-50">
                                                        Editar usuario
                                                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 border-4 border-transparent border-t-blue-700"></span>
                                                    </span>
                                            </a>
                                            <form method="POST" action="?route=delete_user" onsubmit="return confirm('¿Eliminar este usuario?')">
                                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                <button type="submit" class="group relative justify-center">
                                                    <svg class="h-5 w-5 text-red-500 hover:text-red-700 transition-colors cursor-pointer" fill="currentColor" viewBox="0 0 640 640">
                                                    <path d="M262.2 48C248.9 48 236.9 56.3 232.2 68.8L216 112L120 112C106.7 112 96 122.7 96 136C96 
                                                    149.3 106.7 160 120 160L520 160C533.3 160 544 149.3 544 136C544 122.7 533.3 112 520 112L424 
                                                    112L407.8 68.8C403.1 56.3 391.2 48 377.8 48L262.2 48zM128 208L128 512C128 547.3 156.7 576 192 
                                                    576L448 576C483.3 576 512 547.3 512 512L512 208L464 208L464 512C464 520.8 456.8 528 448 528L192 
                                                    528C183.2 528 176 520.8 176 512L176 208L128 208zM288 280C288 266.7 277.3 256 264 256C250.7 256 
                                                    240 266.7 240 280L240 456C240 469.3 250.7 480 264 480C277.3 480 288 469.3 288 456L288 280zM400 
                                                    280C400 266.7 389.3 256 376 256C362.7 256 352 266.7 352 280L352 456C352 469.3 362.7 480 376 480C389.3 480 400 469.3 400 456L400 280z"/></svg>
                                                    <span class="pointer-events-none absolute -top-10 left-1/2 -translate-x-1/2 whitespace-nowrap rounded 
                                                    bg-red-700 px-2 py-1 text-xs font-medium text-white opacity-0 transition-opacity group-hover:opacity-100 shadow-lg z-50">
                                                        Eliminar usuario
                                                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 border-4 border-transparent border-t-red-700"></span>
                                                    </span>
                                            </button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div id="emptyUsersState" class="hidden mt-3 text-sm text-gray-500 bg-gray-50 border border-gray-200 rounded-md px-4 py-3">
                No hay usuarios que coincidan con los filtros.
            </div>
        </div>
    </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('userSearch');
    var roleFilter = document.getElementById('roleFilter');
    var ownerFilter = document.getElementById('ownerFilter');
    var clearButton = document.getElementById('clearUserFilters');
    var usersCount = document.getElementById('usersCount');
    var emptyState = document.getElementById('emptyUsersState');
    var rows = Array.prototype.slice.call(document.querySelectorAll('#usersTableBody tr[data-user-id]'));

    if (!searchInput || !roleFilter || !ownerFilter || !clearButton || !usersCount || !emptyState) {
        return;
    }

    var totalUsers = rows.length;

    function applyFilters() {
        var keyword = searchInput.value.trim().toLowerCase();
        var selectedRole = roleFilter.value;
        var selectedOwner = ownerFilter.value;
        var visibleCount = 0;

        rows.forEach(function (row) {
            var rowId = row.getAttribute('data-user-id') || '';
            var rowUsername = (row.getAttribute('data-username') || '').toLowerCase();
            var rowRole = row.getAttribute('data-role') || '';
            var rowIsSelf = row.getAttribute('data-is-self') === '1';

            var matchesKeyword = keyword === '' || rowId.indexOf(keyword) !== -1 || rowUsername.indexOf(keyword) !== -1;
            var matchesRole = selectedRole === 'all' || rowRole === selectedRole;
            var matchesOwner = selectedOwner === 'all' || (selectedOwner === 'self' && rowIsSelf) || (selectedOwner === 'others' && !rowIsSelf);
            var isVisible = matchesKeyword && matchesRole && matchesOwner;

            row.classList.toggle('hidden', !isVisible);
            if (isVisible) {
                visibleCount += 1;
            }
        });

        usersCount.textContent = 'Mostrando ' + visibleCount + ' de ' + totalUsers + ' usuarios';
        emptyState.classList.toggle('hidden', visibleCount > 0);
    }

    clearButton.addEventListener('click', function () {
        searchInput.value = '';
        roleFilter.value = 'all';
        ownerFilter.value = 'all';
        applyFilters();
    });

    searchInput.addEventListener('input', applyFilters);
    roleFilter.addEventListener('change', applyFilters);
    ownerFilter.addEventListener('change', applyFilters);

    applyFilters();
});
</script>
<?php require __DIR__ . '/../layout/footer.php'; ?>