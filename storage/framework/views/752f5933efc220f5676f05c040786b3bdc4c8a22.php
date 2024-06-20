

<?php $__env->startSection('title', 'Profile Page'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col justify-center px-6 py-12 lg:px-8 items-center">
    <div class="flex flex-col justify-center px-6 py-12 lg:px-8 items-center">
        <form class="max-w-2xl">
            <div class="flex flex-wrap border shadow rounded-lg p-3 dark:bg-gray-600">
                <h2 class="text-xl text-gray-600 dark:text-gray-300 pb-2">Ubah Profile</h2>

                <div class="flex flex-col gap-2 w-full border-gray-400">

                    <div>
                        <label class="text-gray-600 dark:text-gray-400">User
                            name
                        </label>
                        <input
                            class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow dark:bg-gray-600 dark:text-gray-100"
                            type="text">
                    </div>

                    <div>
                        <label class="text-gray-600 dark:text-gray-400">Email</label>
                        <input
                            class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow dark:bg-gray-600 dark:text-gray-100"
                            type="text">
                    </div>

                    <div>
                        <label class="text-gray-600 dark:text-gray-400">Password</label>
                        <input
                            class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow dark:bg-gray-600 dark:text-gray-100"
                            type="password">
                    </div>

                    <div class="flex justify-end">
                        <button
                            class="py-1.5 px-3 m-1 text-center bg-blue-500 text-white rounded-md hover:bg-blue-600 hover:text-gray-200"
                            type="submit">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\NATHANIEL ORION\Downloads\Werehousing\resources\views/profile.blade.php ENDPATH**/ ?>