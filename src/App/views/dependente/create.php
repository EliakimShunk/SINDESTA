<?php include $this->resolve("partials/_header.php"); ?>

    <section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
        <form method="POST" class="grid grid-cols-1 gap-6">
            <?php include $this->resolve("partials/_csrf.php"); ?>
            <input value="<?php echo e($aFiliado['flo_id']); ?>" name="flo_id" type="hidden">
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
                <span class="text-gray-700">Data de Nascimento</span>
                <input value="<?php echo e($aOldFormData['birthDate'] ?? ''); ?>" name="birthDate" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('birthDate', $aErrors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($aErrors['birthDate'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Relacionamento</span>
                <input value="<?php echo e($aOldFormData['relationship'] ?? ''); ?>" name="relationship" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('relationship', $aErrors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($aErrors['relationship'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
                Cadastrar Novo Dependente
            </button>
        </form>
    </section>

<?php include $this->resolve("partials/_footer.php"); ?>