<?php $title = 'Accueil'; ?>

<div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
        <h1 class="display-4 font-italic">Sébastien Thuret</h1>
        <p class="lead my-3">le développeur qu’il vous faut !</p>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            Derniers articles
        </h3>
    </div>
    <div class="col-md-4">
        <div class="p-4 mb-3 bg-light rounded">
            <h4 class="font-italic">Contactez-moi</h4>
            <form action="#" method="post" class="mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact-firstname">Prénom</label>
                            <input type="text" id="contact-firstname" name="contact-firstname" class="form-control" placeholder="Prénom">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact-lastname">Nom</label>
                            <input type="text" id="contact-lastname" name="contact-lastname" class="form-control" placeholder="Nom">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="contact-email">Adresse email</label>
                            <input type="text" id="contact-email" name="contact-email" class="form-control" placeholder="Adresse email">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="contact-message">Message</label>
                            <textarea type="text" id="contact-message" name="contact-message" class="form-control" placeholder="Message"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="mt-3 btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</div>
