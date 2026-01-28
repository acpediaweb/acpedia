<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    /* Dark Mode Overrides for Quill */
    .ql-toolbar { 
        background-color: #374151; 
        border-color: #4b5563 !important; 
        color: white; 
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }
    .ql-container { 
        background-color: #1f2937; 
        border-color: #4b5563 !important; 
        color: white; 
        font-size: 1rem; 
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
        min-height: 200px;
    }
    .ql-stroke { stroke: #d1d5db !important; }
    .ql-fill { fill: #d1d5db !important; }
    .ql-picker { color: #d1d5db !important; }
    
    /* Classic Forum Layout Helpers */
    .post-container { 
        display: flex; 
        flex-direction: column; 
        border: 1px solid #374151; 
        margin-bottom: 1.5rem; 
        background: #1f2937; 
        border-radius: 0.5rem; 
        overflow: hidden; 
    }
    .post-header { 
        background: #111827; 
        padding: 0.5rem 1rem; 
        border-bottom: 1px solid #374151; 
        font-size: 0.875rem; 
        color: #9ca3af; 
        display: flex; 
        justify-content: space-between; 
        align-items: center;
    }
    .post-body { 
        display: flex; 
        flex-direction: column; 
    }
    
    /* Desktop: Sidebar on left */
    @media (min-width: 768px) {
        .post-body { flex-direction: row; }
        .user-sidebar { 
            width: 220px; 
            flex-shrink: 0; 
            border-right: 1px solid #374151; 
            background: #18202f; 
        }
    }
    
    .user-sidebar { 
        padding: 1.5rem; 
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        text-align: center; 
    }
    .post-content { 
        flex-grow: 1; 
        padding: 1.5rem; 
        min-height: 200px; 
    }
    .user-avatar { 
        width: 96px; 
        height: 96px; 
        margin-bottom: 1rem; 
        border: 4px solid #374151; 
        border-radius: 50%; 
        overflow: hidden; 
        background-color: #374151;
    }
</style>

<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white"><?= esc($thread->thread_title) ?></h1>
            <p class="text-gray-400 mt-1">
                Started by <span class="text-blue-400 font-semibold"><?= esc($thread->author_name ?? 'Unknown') ?></span> 
                on <?= date('M d, Y', strtotime($thread->created_at)) ?>
            </p>
        </div>
        <div class="flex gap-2">
            <?php if ($thread->status === 'Closed'): ?>
                <form action="<?= base_url('admin/forum/' . $thread->id . '/reopen') ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded font-semibold transition-colors shadow-sm">
                        Unlock Thread
                    </button>
                </form>
            <?php else: ?>
                <form action="<?= base_url('admin/forum/' . $thread->id . '/close') ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded font-semibold transition-colors shadow-sm"
                        onclick="return confirm('Lock this thread? No further replies will be allowed.')">
                        Lock Thread
                    </button>
                </form>
            <?php endif; ?>
            <a href="<?= base_url('admin/forum') ?>" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded font-semibold transition-colors shadow-sm">
                Back to List
            </a>
        </div>
    </div>

    <?php if ($thread->status === 'Closed'): ?>
        <div class="bg-red-900/30 border border-red-800 text-red-200 px-4 py-3 rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <span class="font-semibold">This thread is locked. No further replies are allowed.</span>
        </div>
    <?php endif; ?>

    <div class="space-y-0">
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $index => $post): ?>
                <div class="post-container" id="post-<?= $post->id ?>">
                    <div class="post-header">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-400"><?= date('F j, Y, g:i a', strtotime($post->created_at)) ?></span>
                            <?php if ($index === 0): ?>
                                <span class="px-2 py-0.5 bg-blue-900 text-blue-200 text-xs rounded uppercase font-bold tracking-wider">OP</span>
                            <?php endif; ?>
                        </div>
                        <a href="#post-<?= $post->id ?>" class="text-gray-500 hover:text-white transition-colors">#<?= $index + 1 ?></a>
                    </div>

                    <div class="post-body">
                        <div class="user-sidebar">
                            <div class="user-avatar">
                                <?php if (!empty($post->profile_picture)): ?>
                                    <img src="<?= base_url('file/uploads/' . $post->profile_picture) ?>" 
                                         alt="<?= esc($post->fullname) ?>"
                                         class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full bg-gray-700 flex items-center justify-center text-3xl font-bold text-gray-500">
                                        <?= strtoupper(substr($post->fullname ?? 'A', 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <h3 class="text-blue-400 font-bold text-lg mb-1 break-words w-full leading-tight">
                                <?= esc($post->fullname ?? 'Guest') ?>
                            </h3>
                            
                            <div class="mb-4">
                                <?php if (isset($post->post_author_id) && $post->post_author_id == $thread->thread_poster_id): ?>
                                    <span class="px-2 py-0.5 bg-blue-600 text-white text-xs rounded font-semibold">Author</span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 bg-gray-700 text-gray-300 text-xs rounded">Member</span>
                                <?php endif; ?>
                            </div>

                            <div class="text-xs text-gray-400 space-y-1 w-full text-left md:text-center border-t border-gray-700 pt-3 mt-auto md:mt-0">
                                <div class="flex justify-between md:block">
                                    <span class="md:text-gray-500">Joined:</span>
                                    <span class="text-gray-300 block">
                                        <?= !empty($post->member_since) ? date('M Y', strtotime($post->member_since)) : '-' ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="post-content">
                            <div class="prose prose-invert max-w-none text-gray-200">
                                <?= $post->post_content ?> 
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-12 bg-gray-800 border border-gray-700 rounded-lg text-gray-400">
                <p>No posts found in this thread.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($thread->status !== 'Closed'): ?>
        <div class="mt-8 pt-6 border-t border-gray-700">
            <h3 class="text-xl font-bold text-white mb-4">Post a Reply</h3>
            <form action="<?= base_url('admin/forum/' . $thread->id . '/reply') ?>" method="post" id="replyForm">
                <?= csrf_field() ?>
                
                <div class="mb-4">
                    <div id="editor-container"></div>
                </div>
                
                <input type="hidden" name="post_content" id="post_content">

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded shadow-lg transition-transform transform hover:scale-105">
                        Submit Reply
                    </button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    <?php if ($thread->status !== 'Closed'): ?>
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Write your reply here...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'header': [1, 2, 3, false] }],
                    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                    [{ 'align': [] }],
                    ['clean']                                         // remove formatting button
                ]
            }
        });

        // Intercept form submission to put HTML into hidden input
        document.querySelector('#replyForm').onsubmit = function(e) {
            // Populate hidden input
            var html = quill.root.innerHTML;
            document.querySelector('#post_content').value = html; // FIXED: Target new ID

            // Simple validation check for empty content
            if (quill.getText().trim().length === 0) {
                alert('Please enter a reply.');
                e.preventDefault();
                return false;
            }
        };
    <?php endif; ?>
</script>

<?= $this->endSection() ?>