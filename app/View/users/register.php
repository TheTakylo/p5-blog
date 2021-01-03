<?php $title = 'Inscription'; ?>


<div class="row my-5">
    <div class="col-md-6 offset-3">
        <div class="card">
            <div class="card-header">Inscription</div>
            <div class="card-body">
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form-firstname">Prénom</label>
                                <input type="text" id="form-firstname" name="form-firstname" class="form-control" placeholder="Prénom">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form-lastname">Nom</label>
                                <input type="text" id="form-lastname" name="form-lastname" class="form-control" placeholder="Nom">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form-email">Adresse email</label>
                                <input type="email" id="form-email" name="form-email" class="form-control" placeholder="Adresse email">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form-password">Mot de passe</label>
                                <input type="password" id="form-password" name="form-password" class="form-control" placeholder="Mot de passe">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="checkbox" id="form-checkbox" name="form-checkbox" class="form-check-input">
                                <label for="form-checkbox">J'accepte les <a href="#">conditions d'utilisations</a></label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="mt-3 btn btn-primary">Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>

