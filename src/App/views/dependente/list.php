<?php include $this->resolve("partials/_header.php"); ?>
    <!-- Start Main Content Area -->
    <section class="container mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h4 class="font-medium">Lista de Dependentes (<?php echo e($aFiliado['flo_name']) ?>)</h4>
            <div class="flex space-x-4">
                <a href="/filiado/<?php echo e($aFiliado['flo_id']); ?>/dependente" class="flex items-center p-2 bg-sky-50 text-xs text-sky-900 hover:bg-sky-500 hover:text-white transition rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    Novo Dependente
                </a>
            </div>
        </div>
        <!-- List -->
        <table class="table-auto min-w-full divide-y divide-gray-300 mt-6">
            <thead class="bg-gray-50">
            <tr>
                <th class="p-4 text-left text-sm font-semibold text-gray-900">
                    Nome
                </th>
                <th class="p-4 text-left text-sm font-semibold text-gray-900">
                    Data de Nascimento
                </th>
                <th class="p-4 text-left text-sm font-semibold text-gray-900">
                    Relacionamento
                </th>
                <th>Acoes</th>
            </tr>
            </thead>
            <!-- Table Body -->
            <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($aDependentes as $aDependente) : ?>
                <tr>
                    <!-- Nome -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($aDependente['nome'])?></td>
                    <!-- Data de Nascimento -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($aDependente['birthDate'])?></td>
                    <!-- Relacionamento -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($aDependente['relationship'])?></td>
                    <!-- Acoes -->
                    <td class="p-4 text-sm text-gray-600 flex justify-center space-x-2">
                        <a href="/filiado/<?php echo e($aDependente['flo_id']); ?>/dependente/<?php echo e($aDependente['id']); ?>" class="p-2 bg-emerald-50 text-xs
                text-emerald-900 hover:bg-emerald-500 hover:text-white transition rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897
                              1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25
                               0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                        <form action="/filiado/<?php echo e($aDependente['flo_id']); ?>/dependente/<?php echo e($aDependente['id']); ?>" method="post">
                            <input type="hidden" name="_method" value="delete"/>

                            <?php include $this->resolve('partials/_csrf.php'); ?>

                            <button type="submit" class="p-2 bg-red-50 text-xs text-red-900
                    hover:bg-red-500 hover:text-white transition rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26
                            9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244
                            2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12
                             .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5
                             0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09
                             2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <!-- End Main Content Area -->
<?php include $this->resolve("partials/_footer.php"); ?>