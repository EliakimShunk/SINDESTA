<?php include $this->resolve("partials/_header.php"); ?>

    <section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
        <form method="POST" class="grid grid-cols-1 gap-6">
            <?php include $this->resolve("partials/_csrf.php"); ?>
            <label class="block">
                <span class="text-gray-700">Nome</span>
                <input value="<?php echo e($dependente['dpe_name']); ?>" name="nome" type="text" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                <?php if (array_key_exists('nome', $errors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo $errors['nome'][0]; ?>
                    </div>
                <?php endif; ?>
            </label>
            <label class="block">
                <span class="text-gray-700">Data de Nascimento</span>
                <p><?php echo e($dependente['formatted_birthDate']); ?></p>
            </label>
            <label class="block">
                <span class="text-gray-700">Relacionamento</span>
                <p><?php echo e($dependente['dpe_relationship']); ?></p>
            </label>
            <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
                Editar
            </button>
        </form>
    </section>

<?php include $this->resolve("partials/_footer.php"); ?>