<?php include $this->resolve("partials/_header.php"); ?>

    <section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
        <form method="POST" class="grid grid-cols-1 gap-6">
            <?php include $this->resolve("partials/_csrf.php"); ?>

            <label class="block">
                <span class="text-gray-700">Nome</span>
                <input value="<?php echo e($oldFormData['nome'] ?? ''); ?>" name="nome" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('nome', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($errors['nome'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">CPF</span>
                <input value="<?php echo e($oldFormData['cpf'] ?? ''); ?>" name="cpf" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('cpf', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($errors['cpf'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">RG</span>
                <input value="<?php echo e($oldFormData['rg'] ?? ''); ?>" name="rg" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('rg', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($errors['rg'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Data de Nascimento</span>
                <input value="<?php echo e($oldFormData['birthDate'] ?? ''); ?>" name="birthDate" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('birthDate', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($errors['birthDate'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Empresa</span>
                <input value="<?php echo e($oldFormData['company'] ?? ''); ?>" name="company" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('company', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($errors['company'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Posicao</span>
                <input value="<?php echo e($oldFormData['position'] ?? ''); ?>" name="position" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('position', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($errors['position'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Situacao</span>
                <input value="<?php echo e($oldFormData['status'] ?? ''); ?>" name="status" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('status', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($errors['status'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Telefone</span>
                <input value="<?php echo e($oldFormData['phone'] ?? ''); ?>" name="phone" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('phone', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($errors['phone'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Celular</span>
                <input value="<?php echo e($oldFormData['cellphone'] ?? ''); ?>" name="cellphone" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('cellphone', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($errors['cellphone'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
                Cadastrar Filiado
            </button>
        </form>
    </section>

<?php include $this->resolve("partials/_footer.php"); ?>