<?php require __DIR__ . '/../layout/header.php'; ?>

<style>
    .glass-panel {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 40px -10px rgba(15, 23, 42, 0.05);
    }
    
    .input-modern {
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(226, 232, 240, 0.8);
        transition: all 0.2s ease;
    }
    
    .input-modern:focus {
        background-color: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    .glass-row {
        transition: background-color 0.2s ease;
    }
    .glass-row:hover {
        background-color: rgba(248, 250, 252, 0.8);
    }
</style>

<div class="container mx-auto px-4 lg:px-8 py-8 w-full max-w-7xl relative overflow-hidden min-h-[calc(100vh-100px)]">
    
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4 mt-4 md:mt-0">
        <div class="flex items-center gap-3">
            <div class="h-12 w-12 rounded-xl bg-[#010b50]/5 text-[#010b50] flex items-center justify-center shadow-sm border border-blue-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Usuarios</h2>
                <p class="text-sm text-slate-500 mt-1">Gestiona los accesos y roles del sistema operativo.</p>
            </div>
        </div>
        <a href="?route=create_user" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-slate-900/10 transition hover:bg-slate-800 hover:-translate-y-0.5 whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Crear Usuario
        </a>
    </div>

    <?php if(isset($flashError)): ?>
        <div class="mb-6 flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50/80 backdrop-blur-md p-4 shadow-sm">
            <svg class="h-5 w-5 text-rose-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm font-medium text-rose-800"><?= htmlspecialchars($flashError) ?></p>
        </div>
    <?php endif; ?>

    <?php if(isset($flashSuccess)): ?>
        <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50/80 backdrop-blur-md p-4 shadow-sm">
            <svg class="h-5 w-5 text-emerald-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm font-medium text-emerald-800"><?= htmlspecialchars($flashSuccess) ?></p>
        </div>
    <?php endif; ?>

    <?php
        $roles = [];
        foreach ($users as $userItem) {
            $roleValue = trim((string)($userItem['role'] ?? ''));
            if ($roleValue !== '' && !in_array($roleValue, $roles, true)) {
                $roles[] = $roleValue;
            }
        }
        sort($roles, SORT_NATURAL | SORT_FLAG_CASE);

        $formatUserDate = function ($value) {
            if (!is_string($value) || trim($value) === '') return 'No disponible';
            $timestamp = strtotime($value);
            if ($timestamp === false) return 'No disponible';
            return date('d/m/Y - h:i A', $timestamp);
        };
    ?>

    <div class="glass-panel p-5 rounded-2xl mb-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="md:col-span-6 lg:col-span-6 relative">
                <label for="userSearch" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Buscar Usuario</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input id="userSearch" type="text" placeholder="ID o nombre de usuario..." class="input-modern block w-full rounded-xl py-2.5 pl-10 pr-3 text-sm text-slate-700 placeholder-slate-400">
                </div>
            </div>
            
            <div class="md:col-span-3 lg:col-span-3">
                <label for="roleFilter" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Rol</label>
                <select id="roleFilter" class="input-modern block w-full rounded-xl py-2.5 px-3 text-sm text-slate-700 cursor-pointer appearance-none">
                    <option value="all">Todos los roles</option>
                    <?php foreach ($roles as $roleOption): ?>
                        <option value="<?= htmlspecialchars($roleOption) ?>"><?= htmlspecialchars($roleOption) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="md:col-span-3 lg:col-span-3">
                <label for="ownerFilter" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Tipo de Cuenta</label>
                <select id="ownerFilter" class="input-modern block w-full rounded-xl py-2.5 px-3 text-sm text-slate-700 cursor-pointer appearance-none">
                    <option value="all">Cualquiera</option>
                    <option value="self">Mi usuario</option>
                    <option value="others">Otros usuarios</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-between mt-4 px-1">
            <p id="usersCount" class="text-[13px] font-medium text-slate-500 bg-slate-100/50 px-3 py-1 rounded-full border border-slate-200/50">Mostrando 0 de 0 usuarios</p>
            <button id="clearUserFilters" type="button" class="text-sm text-indigo-600 font-semibold hover:text-indigo-800 transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                Limpiar filtros
            </button>
        </div>
    </div>

    <div id="usersCards" class="md:hidden space-y-4">
        <?php foreach ($users as $user): ?>
            <?php 
                $isCurrentUser = intval($user['id']) === intval($_SESSION['user_id']); 
                $normalizedUsername = function_exists('mb_strtolower') ? mb_strtolower((string)$user['username'], 'UTF-8') : strtolower((string)$user['username']);
                $initials = strtoupper(substr($user['username'], 0, 2));
            ?>
            <article class="glass-panel rounded-2xl p-5" data-user-id="<?= intval($user['id']) ?>" data-username="<?= htmlspecialchars($normalizedUsername) ?>" data-role="<?= htmlspecialchars((string)$user['role']) ?>" data-is-self="<?= $isCurrentUser ? '1' : '0' ?>">
                <div class="flex items-start justify-between gap-3 mb-4">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-sm">
                            <?= $initials ?>
                        </div>
                        <div>
                            <p class="text-base font-bold text-slate-900 leading-tight"><?= htmlspecialchars($user['username']) ?></p>
                            <p class="text-xs font-medium text-slate-400 mt-0.5">ID: <?= str_pad($user['id'], 4, '0', STR_PAD_LEFT) ?></p>
                        </div>
                    </div>
                    <span class="inline-flex items-center rounded-lg bg-slate-100 border border-slate-200 px-2.5 py-1 text-[11px] font-bold text-slate-600 uppercase tracking-wider">
                        <?= htmlspecialchars($user['role']) ?>
                    </span>
                </div>

                <div class="space-y-2 text-sm bg-white/50 rounded-xl p-3 border border-slate-100">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-500 font-medium text-xs">Departamento</span>
                        <span class="text-slate-800 font-semibold text-xs"><?= htmlspecialchars($user['department'] ?? 'N/D') ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-500 font-medium text-xs">Modificado</span>
                        <span class="text-slate-800 font-semibold text-xs"><?= htmlspecialchars($formatUserDate($user['updated_at'] ?? null)) ?></span>
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-end gap-2">
                    <?php if ($isCurrentUser): ?>
                        <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 border border-emerald-100 px-3 py-1.5 rounded-lg flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Tu cuenta
                        </span>
                    <?php else: ?>
                        <a href="?route=edit_user&id=<?= $user['id'] ?>" class="flex-1 text-center py-2 text-sm font-semibold text-indigo-700 bg-indigo-50 border border-indigo-100 rounded-xl hover:bg-indigo-100 transition-colors">
                            Editar
                        </a>
                        <form method="POST" action="?route=delete_user" class="flex-1" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <button type="submit" class="w-full py-2 text-sm font-semibold text-rose-700 bg-rose-50 border border-rose-100 rounded-xl hover:bg-rose-100 transition-colors">
                                Eliminar
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <div class="hidden md:block glass-panel rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-slate-50/80 border-b border-slate-200/80">
                    <tr>
                        <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Usuario</th>
                        <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Rol</th>
                        <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Departamento</th>
                        <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Creación</th>
                        <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody" class="divide-y divide-slate-100/80 bg-white/40">
                    <?php foreach ($users as $user): ?>
                        <?php 
                            $isCurrentUser = intval($user['id']) === intval($_SESSION['user_id']); 
                            $normalizedUsername = function_exists('mb_strtolower') ? mb_strtolower((string)$user['username'], 'UTF-8') : strtolower((string)$user['username']);
                            $initials = strtoupper(substr($user['username'], 0, 2));
                        ?>
                        <tr class="glass-row" data-user-id="<?= intval($user['id']) ?>" data-username="<?= htmlspecialchars($normalizedUsername) ?>" data-role="<?= htmlspecialchars((string)$user['role']) ?>" data-is-self="<?= $isCurrentUser ? '1' : '0' ?>">
                            
                            <td class="py-4 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 rounded-full bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold text-xs border border-indigo-100">
                                        <?= $initials ?>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800"><?= htmlspecialchars($user['username']) ?></span>
                                        <span class="text-[11px] text-slate-400 font-medium">ID: #<?= str_pad($user['id'], 4, '0', STR_PAD_LEFT) ?></span>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="py-4 px-5">
                                <span class="inline-flex items-center rounded-lg bg-slate-100 border border-slate-200 px-2.5 py-1 text-[11px] font-bold text-slate-600 uppercase tracking-wider">
                                    <?= htmlspecialchars($user['role']) ?>
                                </span>
                            </td>
                            
                            <td class="py-4 px-5 font-medium text-slate-600">
                                <?= htmlspecialchars($user['department'] ?? 'No especificado') ?>
                            </td>
                            
                            <td class="py-4 px-5 text-[13px] text-slate-500 font-medium">
                                <?= htmlspecialchars($formatUserDate($user['created_at'] ?? null)) ?>
                            </td>
                            
                            <td class="py-4 px-5">
                                <?php if ($isCurrentUser): ?>
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-lg">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Tu cuenta
                                    </span>
                                <?php else: ?>
                                    <div class="flex items-center gap-2">
                                        <a href="?route=edit_user&id=<?= $user['id'] ?>" class="group relative p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span class="pointer-events-none absolute -top-10 left-1/2 -translate-x-1/2 whitespace-nowrap rounded bg-slate-800 px-2.5 py-1 text-[11px] font-medium text-white opacity-0 transition-opacity group-hover:opacity-100 shadow-lg z-50">
                                                Editar
                                                <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 border-4 border-transparent border-t-slate-800"></span>
                                            </span>
                                        </a>

                                        <form method="POST" action="?route=delete_user" class="inline-block" onsubmit="return confirm('¿Eliminar este usuario de forma permanente?')">
                                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                            <button type="submit" class="group relative p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span class="pointer-events-none absolute -top-10 left-1/2 -translate-x-1/2 whitespace-nowrap rounded bg-rose-700 px-2.5 py-1 text-[11px] font-medium text-white opacity-0 transition-opacity group-hover:opacity-100 shadow-lg z-50">
                                                    Eliminar
                                                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 border-4 border-transparent border-t-rose-700"></span>
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
    </div>

    <div id="emptyUsersState" class="hidden mt-6 text-center glass-panel rounded-2xl p-10">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 text-slate-400 mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path><line x1="3" y1="3" x2="21" y2="21" stroke-width="2" stroke-linecap="round"></line></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800">No se encontraron usuarios</h3>
        <p class="text-sm text-slate-500 mt-1 max-w-sm mx-auto">No hay resultados que coincidan con tu búsqueda actual. Intenta cambiar los filtros.</p>
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
    var desktopRows = Array.prototype.slice.call(document.querySelectorAll('#usersTableBody tr[data-user-id]'));
    var mobileCards = Array.prototype.slice.call(document.querySelectorAll('#usersCards [data-user-id]'));
    var mobileCardsById = {};

    if (!searchInput || !roleFilter || !ownerFilter || !clearButton || !usersCount || !emptyState) {
        return;
    }

    mobileCards.forEach(function (card) {
        var cardId = card.getAttribute('data-user-id') || '';
        if (cardId !== '') {
            mobileCardsById[cardId] = card;
        }
    });

    var totalUsers = desktopRows.length;

    function applyFilters() {
        var keyword = searchInput.value.trim().toLowerCase();
        var selectedRole = roleFilter.value;
        var selectedOwner = ownerFilter.value;
        var visibleCount = 0;

        desktopRows.forEach(function (row) {
            var rowId = row.getAttribute('data-user-id') || '';
            var rowUsername = (row.getAttribute('data-username') || '').toLowerCase();
            var rowRole = row.getAttribute('data-role') || '';
            var rowIsSelf = row.getAttribute('data-is-self') === '1';

            var matchesKeyword = keyword === '' || rowId.indexOf(keyword) !== -1 || rowUsername.indexOf(keyword) !== -1;
            var matchesRole = selectedRole === 'all' || rowRole === selectedRole;
            var matchesOwner = selectedOwner === 'all' || (selectedOwner === 'self' && rowIsSelf) || (selectedOwner === 'others' && !rowIsSelf);
            var isVisible = matchesKeyword && matchesRole && matchesOwner;
            var linkedCard = mobileCardsById[rowId] || null;

            row.classList.toggle('hidden', !isVisible);
            if (linkedCard) {
                linkedCard.classList.toggle('hidden', !isVisible);
            }
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