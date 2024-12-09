<?php include $this->resolve("partials/_header.php"); ?>

<section
    class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded"
>
    <form method="post" class="grid grid-cols-1 gap-6">
        <?php include $this->resolve('partials/_csrf.php'); ?>
        <!-- Usuario -->
        <label class="block">
            <span class="text-gray-700">Usuario</span>
            <input value="<?php echo e($oldFormData['usuario'] ?? ''); ?>" name ="usuario"
                type="text"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Insira o nome do usuario"
            />
            <?php if (array_key_exists('usuario', $errors)) : ?>
            <div class="bg-gray-100 mt-2 p-2 text-red-500">
                <?php echo e($errors['usuario'][0]); ?>
            </div>
            <?php endif; ?>
        </label>
        <!-- Password -->
        <label class="block">
            <span class="text-gray-700">Senha</span>
            <input name="password"
                type="password"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Insira a senha"
            />
            <?php if (array_key_exists('password', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500">
                    <?php echo e($errors['password'][0]); ?>
                </div>
            <?php endif; ?>
        </label>
        <!-- Confirm Password -->
        <label class="block">
            <span class="text-gray-700">Confirmar Senha</span>
            <input name="confirmPassword"
                type="password"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Confirme a senha"
            />
            <?php if (array_key_exists('confirmPassword', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500">
                    <?php echo e($errors['confirmPassword'][0]); ?>
                </div>
            <?php endif; ?>
        </label>
        <div class="block">
            <div class="mt-2">
                <div>
                    <label class="inline-flex items-center">
                        <input
                            <?php echo isset($oldFormData['isAdmin']) && $oldFormData['isAdmin'] === '1'
                                ? 'checked'
                                : ''; ?>
                                name="isAdmin"
                                value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                                type="radio"
                        />
                        <span class="ml-2">Administrador</span>
                    </label>
                </div>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input
                            <?php echo isset($oldFormData['isAdmin']) && $oldFormData['isAdmin'] === '2'
                                ? 'checked'
                                : ''; ?>
                                name="isAdmin"
                                value="2"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                                type="radio"
                        />
                        <span class="ml-2">Comum</span>
                    </label>
                    <?php if (!isset($oldFormData['isAdmin']) && array_key_exists('isAdmin', $errors)) : ?>
                        <div class="bg-gray-100 mt-2 p-2 text-red-500">
                            <?php echo e($errors['isAdmin'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <button
            type="submit"
            class="block w-full py-2 bg-indigo-600 text-white rounded"
        >
            Submit
        </button>
    </form>
</section>
<?php include $this->resolve("partials/_footer.php"); ?>