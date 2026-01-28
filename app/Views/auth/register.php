<?= $this->extend('layouts/company_profile') ?>

<?= $this->section('content') ?>
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-3xl shadow-xl">
        
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Create Account</h2>
            <p class="mt-2 text-sm text-gray-600">Join HVACPRO to track your unit history and book professional services.</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-xs font-bold text-center border border-red-100">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form class="mt-8 space-y-6" action="<?= base_url('register/attempt') ?>" method="POST">
            <?= csrf_field() ?>
            
            <div class="space-y-5">
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Full Name</label>
                    <input name="fullname" type="text" required value="<?= old('fullname') ?>"
                        placeholder="John Doe"
                        class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-gray-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all sm:text-sm">
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Email Address</label>
                    <input name="email" type="email" required value="<?= old('email') ?>"
                        placeholder="john@example.com"
                        class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-gray-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all sm:text-sm">
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Password</label>
                    <input name="password" type="password" required 
                        placeholder="••••••••"
                        class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-gray-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all sm:text-sm">
                    <p class="text-[10px] text-gray-400 mt-2 px-1 italic">Use at least 8 characters with a mix of letters and numbers.</p>
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-2xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-lg shadow-blue-200">
                    Get Started
                </button>
            </div>

            <div class="text-center pt-4 border-t border-gray-50">
                <p class="text-xs text-gray-500">
                    Already have an account? 
                    <a href="<?= base_url('login') ?>" class="text-blue-600 font-bold hover:underline ml-1">Sign in instead</a>
                </p>
            </div>
        </form>

    </div>
</div>
<?= $this->endSection() ?>