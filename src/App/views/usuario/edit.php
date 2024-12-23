<?php include $this->resolve("partials/_header.php"); ?>

    <section
        class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded"
    >
        <form method="post" class="grid grid-cols-1 gap-6">
            <?php include $this->resolve('partials/_csrf.php'); ?>
            <!-- ID -->
            <label class="block">
                <span class="text-gray-700">ID</span>
                <p><?php echo e($aUsuario['usr_id'] ?? ''); ?></p>
            </label>
            <!-- Usuario -->
            <label class="block">
                <span class="text-gray-700">Usuario</span>
                <input value="<?php echo e($aUsuario['usr_username'] ?? ''); ?>" name ="usuario"
                       type="text"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       placeholder="Insira o nome do usuario"
                />
                <?php if (array_key_exists('usuario', $aErrors)) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo e($aErrors['usuario'][0]); ?>
                    </div>
                <?php endif; ?>
            </label>
            <button
                type="submit"
                class="block w-full py-2 bg-indigo-600 text-white rounded"
            >
                Editar
            </button>
        </form>
    </section>
<?php include $this->resolve("partials/_footer.php"); ?>