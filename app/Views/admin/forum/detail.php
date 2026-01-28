<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    /* Dark Mode Theme for Quill */
    .ql-toolbar { background-color: #374151; border-color: #4b5563 !important; color: white; }
    .ql-container { background-color: #1f2937; border-color: #4b5563 !important; color: white; font-size: 1rem; }
    .ql-stroke { stroke: #d1d5db !important; }
    .ql-fill { fill: #d1d5db !important; }
    .ql-picker { color: #d1d5db !important; }
    
    /* Post Layout (vBulletin Style) */
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
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded font-semibold transition-colors">
                        Reopen Thread
                    </button>
                </form>
            <?php else: ?>
                <form action="<?= base_url('admin/forum/' . $thread->id . '/close') ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded font-semibold transition-colors"
                        onclick="return confirm('Lock this thread? Users will no longer be able to reply.')">
                        Close Thread
                    </button>
                </form>
            <?php endif; ?>
            
            <a href="<?= base_url('admin/forum') ?>" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded font-semibold transition-colors">
                Back
            </a>
        </div>
    </div>

    <?php if ($thread->status === 'Closed'): ?>
        <div class="bg-red-900/30 border border-red-800 text-red-200 px-4 py-3 rounded flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            <span class="font-semibold">This thread is closed. No further replies are allowed.</span>
        </div>
    <?php endif; ?>

    <div class="space-y-0">
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $index => $post): ?>
                <div class="post-container" id="post-<?= $post->id ?>">
                    <div class="post-header">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-400"><?= date('F j, Y, g:i A', strtotime($post->created_at)) ?></span>
                        </div>
                        <a href="#post-<?= $post->id ?>" class="text-gray-500 hover:text-white transition-colors font-mono">#<?= $index + 1 ?></a>
                    </div>

                    <div class="post-body">
                        <div class="user-sidebar">
                            <div class="user-avatar shadow-lg">
                                <?php if (!empty($post->profile_picture)): ?>
                                    <img src="<?= base_url('file/uploads/' . $post->profile_picture) ?>" 
                                         alt="<?= esc($post->fullname) ?>"
                                         class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-gray-700 text-3xl font-bold text-gray-500">
                                        <?= strtoupper(substr($post->fullname ?? 'G', 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <h3 class="text-blue-400 font-bold text-lg mb-1 break-words w-full">
                                <a href="<?= base_url('admin/users/' . ($post->post_author_id ?? 0) . '/edit') ?>" class="hover:underline">
                                    <?= esc($post->fullname ?? 'Guest') ?>
                                </a>
                            </h3>
                            
                            <div class="mb-4">
                                <span class="px-2 py-0.5 bg-gray-700 border border-gray-600 text-xs rounded text-gray-300">
                                    Member
                                </span>
                            </div>

                            <div class="text-xs text-gray-400 space-y-1 w-full text-left md:text-center border-t border-gray-700 pt-3 mt-auto md:mt-0">
                                <div class="flex justify-between md:block">
                                    <span>Joined:</span>
                                    <span class="text-gray-300 block font-medium">
                                        <?= !empty($post->member_since) ? date('M Y', strtotime($post->member_since)) : '-' ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="post-content">
                            <div class="prose prose-invert max-w-none text-gray-200">
                                <?= $post->content ?> 
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-12 bg-gray-800 border border-gray-700 rounded text-gray-400">
                <p>No posts found in this thread.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($thread->status !== 'Closed'): ?>
        <div class="mt-8">
            <h3 class="text-xl font-bold text-white mb-4">Post a Reply</h3>
            
            <form action="<?= base_url('admin/forum/' . $thread->id . '/reply') ?>" method="post" id="replyForm">
                <?= csrf_field() ?>
                
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg border border-gray-700">
                    <div id="editor-container" style="height: 300px;"></div>
                </div>
                
                <input type="hidden" name="content" id="hiddenContent">

                <div class="mt-4 flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded transition-colors shadow-lg flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
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
        document.addEventListener('DOMContentLoaded', function() {
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
                        ['link', 'image', 'clean']                        // remove formatting button
                    ]
                }
            });

            // On form submit, copy HTML from Quill to hidden input
            var form = document.getElementById('replyForm');
            form.onsubmit = function() {
                // Populate hidden form on submit
                var html = quill.root.innerHTML;
                document.getElementById('hiddenContent').value = html;
                
                // Optional: Check for empty content
                if (quill.getText().trim().length === 0) {
                    alert('Please enter a message before replying.');
                    return false;
                }
            };
        });
    <?php endif; ?>
</script>

<?= $this->endSection() ?>