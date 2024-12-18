<?php include $this->resolve("partials/_header.php"); ?>

    <section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
        <form method="POST" class="grid grid-cols-1 gap-6">
            <?php include $this->resolve("partials/_csrf.php"); ?>

            <label class="block">
                <span class="text-gray-700">Nome</span>
                <input value="<?php echo e($aOldFormData['nome'] ?? ''); ?>" name="nome" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('nome', $aErrors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($aErrors['nome'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">CPF</span>
                <input value="<?php echo e($aOldFormData['cpf'] ?? ''); ?>" name="cpf" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('cpf', $aErrors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($aErrors['cpf'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">RG</span>
                <input value="<?php echo e($aOldFormData['rg'] ?? ''); ?>" name="rg" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('rg', $aErrors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($aErrors['rg'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Data de Nascimento</span>
                <input value="<?php echo e($aOldFormData['birthDate'] ?? ''); ?>" name="birthDate" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('birthDate', $aErrors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($aErrors['birthDate'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Empresa</span>
                <input value="<?php echo e($aOldFormData['company'] ?? ''); ?>" name="company" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('company', $aErrors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($aErrors['company'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Posicao</span>
                <input value="<?php echo e($aOldFormData['position'] ?? ''); ?>" name="position" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('position', $aErrors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($aErrors['position'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Situacao</span>
                <input value="<?php echo e($aOldFormData['status'] ?? ''); ?>" name="status" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('status', $aErrors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($aErrors['status'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Telefone</span>
                <input value="<?php echo e($aOldFormData['phone'] ?? ''); ?>" name="phone" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('phone', $aErrors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($aErrors['phone'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Celular</span>
                <input value="<?php echo e($aOldFormData['cellphone'] ?? ''); ?>" name="cellphone" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('cellphone', $aErrors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($aErrors['cellphone'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
                Cadastrar Filiado
            </button>
        </form>
    </section>

<?php include $this->resolve("partials/_footer.php"); ?>