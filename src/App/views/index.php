<?php include $this->resolve("partials/_header.php"); ?>

    <!-- Start Main Content Area -->
    <section class="container mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h4 class="font-medium">Lista de Filiados</h4>
            <div class="flex space-x-4">
                <a href="/filiado" class="flex items-center p-2 bg-sky-50 text-xs text-sky-900 hover:bg-sky-500 hover:text-white transition rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    Novo Filiado
                </a>
            </div>
        </div>
        <!-- Search Form -->
        <form method="get" class="mt-4 w-full">
            <div class="flex">
                <input value="<?php echo e((string) $searchTerm); ?>" name="s" type="text" class="w-full rounded-l-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Pesquisar Nome de Filiado" />
                <button type="submit" class="rounded-r-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Pesquisar
                </button>
            </div>
            <div class="flex mt-4 w-full items-center" style="gap: 10px">
                <label for="f"> Mes de Nascimento:</label>
                <div class="flex" style="justify-content: start; width: 50%">
                    <select name="f" id="f" style="width: 20%" class="rounded-l-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="" <?php echo $filterMonth === '' ? 'selected' : '' ?>>Selecione</option>
                        <option value="1" <?php echo $filterMonth === '1' ? 'selected' : '' ?>>Janeiro</option>
                        <option value="2" <?php echo $filterMonth === '2' ? 'selected' : '' ?>>Fevereiro</option>
                        <option value="3" <?php echo $filterMonth === '3' ? 'selected' : '' ?>>Marco</option>
                        <option value="4" <?php echo $filterMonth === '4' ? 'selected' : '' ?>>Abril</option>
                        <option value="5" <?php echo $filterMonth === '5' ? 'selected' : '' ?>>Maio</option>
                        <option value="6" <?php echo $filterMonth === '6' ? 'selected' : '' ?>>Junho</option>
                        <option value="7" <?php echo $filterMonth === '7' ? 'selected' : '' ?>>Julho</option>
                        <option value="8" <?php echo $filterMonth === '8' ? 'selected' : '' ?>>Agosto</option>
                        <option value="9" <?php echo $filterMonth === '9' ? 'selected' : '' ?>>Setembro</option>
                        <option value="10" <?php echo $filterMonth === '10' ? 'selected' : '' ?>>Outubro</option>
                        <option value="11" <?php echo $filterMonth === '11' ? 'selected' : '' ?>>Novembro</option>
                        <option value="12" <?php echo $filterMonth === '12' ? 'selected' : '' ?>>Dezembro</option>
                    </select>
                    <button type="submit" class="rounded-r-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Filtrar
                    </button>
                </div>
            </div>
        </form>
        <!-- Filiado List -->
        <table class="table-auto min-w-full divide-y divide-gray-300 mt-6">
            <thead class="bg-gray-50">
            <tr>
                <th class="p-4 text-center text-sm font-semibold text-gray-900">
                    Nome
                </th>
                <th class="p-4 text-center text-sm font-semibold text-gray-900">
                    CPF
                </th>
                <th class="p-4 text-center text-sm font-semibold text-gray-900">
                    RG
                </th>
                <th class="p-4 text-center text-sm font-semibold text-gray-900">
                    Data de Nascimento
                </th>
                <th class="p-4 text-center text-sm font-semibold text-gray-900">
                    Idade
                </th>
                <th class="p-4 text-center text-sm font-semibold text-gray-900">
                    Empresa
                </th>
                <th class="p-4 text-center text-sm font-semibold text-gray-900">
                    Posicao
                </th>
                <th class="p-4 text-center text-sm font-semibold text-gray-900">
                    Situacao
                </th>
                <th class="p-4 text-center text-sm font-semibold text-gray-900">
                    Telefone
                </th>
                <th class="p-4 text-center text-sm font-semibold text-gray-900">
                    Celular
                </th>
                <th class="p-4 text-center text-sm font-semibold text-gray-900">
                    Ultima Atualizacao
                </th>
                <th class="p-4 text-center text-sm font-semibold text-gray-900">Acoes</th>
            </tr>
            </thead>
            <!-- Transaction Table Body -->
            <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach ($filiados as $filiado) : ?>
                <tr>
                    <!-- Nome -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($filiado['nome'])?></td>
                    <!-- CPF -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($filiado['cpf'])?></td>
                    <!-- RG -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($filiado['rg'])?></td>
                    <!-- Data de Nascimento -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($filiado['birthDate'])?></td>
                    <!-- Idade -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($filiado['age']); ?></td>
                    <!-- Empresa -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($filiado['company'])?></td>
                    <!-- Posicao -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($filiado['position'])?></td>
                    <!-- Situcao -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($filiado['status'])?></td>
                    <!-- Telefone -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($filiado['phone'])?></td>
                    <!-- Celular -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($filiado['cellphone'])?></td>
                    <!-- Ultima Atualizacao -->
                    <td class="p-4 text-sm text-gray-600"><?php echo e($filiado['lastUpdate'])?></td>
                    <!-- Actions -->
                    <td class="p-4 text-sm text-gray-600 flex justify-center space-x-2">
                        <a href="/filiado/<?php echo e($filiado['id']); ?>/dependentes" class="p-2 bg-amber-50 text-xs text-amber-900 hover:bg-amber-500
                hover:text-white transition rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z
                                M14 3v5h5M16 13H8M16 17H8M10 9H8" />
                            </svg>
                        </a>
                        <a href="/filiado/<?php echo e($filiado['id']); ?>" class="p-2 bg-emerald-50 text-xs
                text-emerald-900 hover:bg-emerald-500 hover:text-white transition rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897
                              1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25
                               0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                        <form action="/filiado/<?php echo e($filiado['id']); ?>" method="post">
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
        <nav class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0 mt-6">
            <!-- Previous Page Link -->
            <div class="-mt-px flex w-0 flex-1">
                <?php if ($currentPage > 1) : ?>
                    <a href="/?<?php echo e($previousPageQuery); ?>" class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                        <svg class="mr-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z" clip-rule="evenodd" />
                        </svg>
                        Anterior
                    </a>
                <?php endif; ?>
            </div>
            <!-- Pages Link -->
            <div class="hidden md:-mt-px md:flex">
                <?php foreach ($pageLinks as $pageNum => $query) : ?>
                    <a
                        href="/?<?php echo e($query); ?>"
                        class="<?php echo $pageNum + 1 === $currentPage
                            ? "border-indigo-500 text-indigo-600"
                            : "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"; ?>
                    inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium">
                        <?php echo $pageNum + 1; ?>
                    </a>
                <?php endforeach; ?>
                <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
            </div>
            <!-- Next Page Link -->
            <div class="-mt-px flex w-0 flex-1 justify-end">
                <?php if ($currentPage < $lastPage) : ?>
                    <a href="/?<?php echo $nextPageQuery; ?>" class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                        Proxima
                        <svg class="ml-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </section>
    <!-- End Main Content Area -->
<?php include $this->resolve("partials/_footer.php"); ?>