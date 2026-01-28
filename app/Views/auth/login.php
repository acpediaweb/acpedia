<?= $this->extend('layouts/company_profile') ?>

<?= $this->section('content') ?>
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-3xl shadow-xl">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
            <p class="mt-2 text-sm text-gray-600">Track your AC history and manage services.</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-xs font-bold text-center">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form class="mt-8 space-y-6" action="<?= base_url('login/attempt') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase">Email Address</label>
                    <input name="email" type="email" required class="appearance-none rounded-xl relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase">Password</label>
                    <input name="password" type="password" required class="appearance-none rounded-xl relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>

            <button type="submit" class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-2xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Sign In
            </button>

            <div class="text-center text-xs text-gray-400">
                Don't have an account? <a href="<?= base_url('register') ?>" class="text-blue-600 font-bold">Register here</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>