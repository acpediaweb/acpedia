<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Frequently Asked Questions<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Frequently Asked Questions</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h5>Categories</h5>
                        <ul class="list-group">
                            <?php foreach ($categories as $category): ?>
                                <li class="list-group-item">
                                    <a href="/faq/category/<?= $category->id ?>"><?= $category->category_name ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <h5>Search FAQs</h5>
                        <form method="get" action="/faq/search" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Search FAQs..." required>
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>

                        <h5>Recent FAQs</h5>
                        <div class="accordion" id="faqAccordion">
                            <?php foreach ($faqs as $index => $faq): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?= $index ?>">
                                        <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>">
                                            <?= $faq->question ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index == 0 ? 'show' : '' ?>" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <?= $faq->answer ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
