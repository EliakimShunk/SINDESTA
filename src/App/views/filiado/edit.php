<?php include $this->resolve("partials/_header.php"); ?>

    <section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
        <form method="POST" class="grid grid-cols-1 gap-6">
            <?php include $this->resolve("partials/_csrf.php"); ?>

            <label class="block">
                <span class="text-gray-700">Nome</span>
                <input value="<?php echo e($filiado['flo_name']); ?>" name="nome" type="hidden">
                <p><?php echo e($filiado['flo_name']); ?></p>
            </label>
            <label class="block">
                <span class="text-gray-700">CPF</span>
                <input value="<?php echo e($filiado['flo_cpf']); ?>" name="cpf" type="hidden">
                <p><?php echo e($filiado['flo_cpf']); ?></p>
            </label>
            <label class="block">
                <span class="text-gray-700">RG</span>
                <input value="<?php echo e($filiado['flo_rg']); ?>" name="rg" type="hidden">
                <p><?php echo e($filiado['flo_rg']); ?></p>
            </label>
            <label class="block">
                <span class="text-gray-700">Data de Nascimento</span>
                <input value="<?php echo e($filiado['flo_birthDate']); ?>" name="birthDate" type="hidden">
                <p><?php echo e($filiado['formatted_birthDate']); ?></p>
            </label>
            <label class="block">
                <span class="text-gray-700">Empresa</span>
                <input value="<?php echo e($filiado['flo_company']); ?>" name="company" type="text" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('company', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo $errors['company'][0]; ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Posicao</span>
                <input value="<?php echo e($filiado['flo_position']); ?>" name="position" type="text" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('position', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo $errors['position'][0]; ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Situacao</span>
                <input value="<?php echo e($filiado['flo_status']); ?>" name="status" type="text" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('status', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo $errors['status'][0]; ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Telefone</span>
                <input value="<?php echo e($filiado['flo_phone']); ?>" name="phone" type="hidden">
                <p><?php echo e($filiado['flo_phone']); ?></p>
            </label>
            <label class="block">
                <span class="text-gray-700">Celular</span>
                <input value="<?php echo e($filiado['flo_cellphone']); ?>" name="cellphone" type="hidden">
                <p><?php echo e($filiado['flo_cellphone']); ?></p>
            </label>
            <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
                Enviar
            </button>
        </form>
    </section>

<?php include $this->resolve("partials/_footer.php"); ?>