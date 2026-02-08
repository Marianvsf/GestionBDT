<?php require __DIR__ . '/../layout/header.php'; ?>
<?php
    $formatCaracas = function ($value) {
        if (empty($value)) { return 'N/D'; }
        try {
            $dt = new DateTime($value, new DateTimeZone('UTC'));
            $dt->setTimezone(new DateTimeZone('America/Caracas'));
            return $dt->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            return htmlspecialchars($value);
        }
    };
?>
<div class="container mx-auto px-4 sm:px-6 lg:px-12 py-6 sm:py-8">
<?php if (empty($requests)): ?>
    <div class="bg-white rounded-lg mt-16 mx-auto shadow w-full max-w-[1080px] p-8 sm:p-10">
        <div class="flex flex-col items-center text-center gap-4">
            <div class="h-16 w-16 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-2xl">
                💬
            </div>
            <h3 class="text-xl sm:text-2xl font-semibold text-gray-800">Sin solicitudes</h3>
            <p class="text-gray-600 max-w-xl">Aun no hay peticiones del centro de ayuda.</p>
            <a href="?route=dashboard" class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600/40">
                Volver al tablero
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="flex items-center justify-between mt-6 sm:mt-10 mb-6">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Solicitudes de Ayuda</h2>
        <a href="?route=dashboard" class="text-sm text-blue-700 hover:underline">Volver al tablero</a>
    </div>

    <div class="bg-transparent sm:bg-white w-full sm:shadow sm:rounded-lg sm:overflow-hidden">
        <table class="w-full text-left border-collapse text-sm">
            <thead class="hidden md:table-header-group">
                <tr class="bg-gray-200 text-gray-700 uppercase text-xs leading-normal">
                    <th class="py-3 px-6">ID</th>
                    <th class="py-3 px-6">Creado</th>
                    <th class="py-3 px-6">Nombre</th>
                    <th class="py-3 px-6">Correo</th>
                    <th class="py-3 px-6">Telefono</th>
                    <th class="py-3 px-6">Asunto</th>
                    <th class="py-3 px-6">Usuario</th>
                    <th class="py-3 px-6">Mensaje</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 font-light block md:table-row-group">
                <?php foreach ($requests as $request): ?>
                    <tr class="bg-white border border-gray-200 rounded-lg mb-4 block md:table-row md:border-b md:mb-0 hover:bg-gray-50 shadow-sm md:shadow-none md:rounded-none">
                        <td class="px-4 py-3 border-b md:border-0 flex justify-between items-center md:table-cell">
                            <span class="font-bold text-gray-700 md:hidden">ID:</span>
                            <span class="font-medium">#<?= intval($request['id']) ?></span>
                        </td>

                        <td class="px-4 py-3 border-b md:border-0 flex justify-between items-center md:table-cell">
                            <span class="font-bold text-gray-700 md:hidden">Creado:</span>
                            <span class="text-xs text-slate-500">
                                <?= $formatCaracas($request['created_at'] ?? null) ?>
                            </span>
                        </td>

                        <td class="px-4 py-3 border-b md:border-0 flex justify-between items-center md:table-cell">
                            <span class="font-bold text-gray-700 md:hidden">Nombre:</span>
                            <span class="font-medium text-slate-700">
                                <?= htmlspecialchars($request['name'] ?? 'N/D') ?>
                            </span>
                        </td>

                        <td class="px-4 py-3 border-b md:border-0 flex justify-between items-center md:table-cell">
                            <span class="font-bold text-gray-700 md:hidden">Correo:</span>
                            <span class="text-xs text-slate-600 break-all">
                                <?= htmlspecialchars($request['email'] ?? 'N/D') ?>
                            </span>
                        </td>

                        <td class="px-4 py-3 border-b md:border-0 flex justify-between items-center md:table-cell">
                            <span class="font-bold text-gray-700 md:hidden">Telefono:</span>
                            <span class="text-xs text-slate-600">
                                <?= htmlspecialchars($request['phone'] ?? 'N/D') ?>
                            </span>
                        </td>

                        <td class="px-4 py-3 border-b md:border-0 flex justify-between items-center md:table-cell">
                            <span class="font-bold text-gray-700 md:hidden">Asunto:</span>
                            <span class="text-sm font-semibold text-slate-700">
                                <?= htmlspecialchars($request['subject'] ?? 'N/D') ?>
                            </span>
                        </td>

                        <td class="px-4 py-3 border-b md:border-0 flex justify-between items-center md:table-cell">
                            <span class="font-bold text-gray-700 md:hidden">Usuario:</span>
                            <span class="text-xs text-slate-600">
                                <?= htmlspecialchars($request['username'] ?? 'Publico') ?>
                            </span>
                        </td>

                        <td class="px-4 py-3 flex flex-col md:table-cell gap-2">
                            <span class="font-bold text-gray-700 md:hidden mb-1">Mensaje:</span>
                            <span class="text-sm text-slate-700 whitespace-pre-line break-words">
                                <?= htmlspecialchars($request['message'] ?? '') ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
