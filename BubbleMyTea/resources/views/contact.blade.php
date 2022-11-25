@extends('layouts.template')
@section('main')

    <div class="contact">
        <form>
            <form>
                <fieldset class="bloc">
                    <legend>Informations</legend>
                    <br>           
                    <label for="Firstname">Nom</label>
                    <input type="text" placeholder="A completer" id="Firstname" required />
                    <br>
                    <label for="Lastname">Prenom</label>
                    <input type="text" placeholder="A completer" id="Lastname" required />
                    <br>
                    <label for="Email">Email</label>
                    <input type="email" placeholder="A completer" id="Email" required />
                    <br>
                    <label for="Phone number">Numéro de téléphone</label>
                    <input type="number" placeholder="A completer" id="Phone number" required />            
                </fieldset>
                <br>
                <fieldset class="bloc">
                    <legend>Message</legend>
                    
                    <label class="sub" for="subject">Objet</label>
                    <select name="subject" id="subject">
                        <option value="">A completer</option>
                        <option value="Remboursement">Remboursement</option>
                        <option value="Demande d'informations">Demande d'informations</option>
                        <option value="Problème technique">Problème technique</option>
                    </select>
                    <br>
                    <label class ="date" for="Current Date">Date actuelle</label>  
                    <input class="margin-b" type="date" id="date">
                    <br>
                    <label for="content">Contenu</label>
                    <textarea name="Content" id="Content"></textarea>
                    
                </fieldset>
                <input class="button" type="button" value='Envoyer' onclick="alert('Votre demande a été enregistrée')"/>
            </form>
        </main>
    </body>
        
@endsection
