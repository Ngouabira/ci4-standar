<?php

namespace Myth\Auth\Language\fr;

return [
    // Exceptions
    'invalidModel' => 'Le modèle {0} doit être chargé avant utilisation.',
    'userNotFound' => 'Impossible de trouver un utilisateur avec l\'ID = {0, number}.',
    'noUserEntity' => 'Une entité utilisateur doit être fournie pour la validation du mot de passe.',
    'tooManyCredentials' => 'Vous ne pouvez valider qu\'une seule référence autre qu\'un mot de passe.',
    'invalidFields' => 'Le champ "{0}" ne peut pas être utilisé pour valider les références.',
    'unsetPasswordLength' => 'Vous devez définir la valeur `minimumPasswordLength` dans le fichier de configuration Auth.',
    'unknownError' => 'Désolé, nous avons rencontré un problème lors de l\'envoi de l\'e-mail. Veuillez réessayer ultérieurement.',
    'notLoggedIn' => 'Vous devez être connecté pour accéder à cette page.',
    'notEnoughPrivilege' => 'Vous n\'avez pas les permissions suffisantes pour accéder à cette page.',

    // Registration
    'registerDisabled' => 'Désolé, la création de nouveaux comptes utilisateur n\'est pas autorisée pour le moment.',
    'registerSuccess' => 'Bienvenue à bord ! Veuillez vous connecter avec vos nouvelles informations d\'identification.',
    'registerCLI' => 'Nouvel utilisateur créé : {0}, #{1}',

    // Activation
    'activationNoUser' => 'Impossible de trouver un utilisateur avec ce code d\'activation.',
    'activationSubject' => 'Activez votre compte',
    'activationSuccess' => 'Veuillez confirmer votre compte en cliquant sur le lien d\'activation dans l\'e-mail que nous avons envoyé.',
    'activationResend' => 'Renvoyez le message d\'activation une fois de plus.',
    'notActivated' => 'Ce compte utilisateur n\'a pas encore été activé.',
    'errorSendingActivation' => 'Échec de l\'envoi du message d\'activation à : {0}',

    // Login
    'badAttempt' => 'Impossible de vous connecter. Veuillez vérifier vos informations d\'identification.',
    'loginSuccess' => 'Bienvenue !',
    'invalidPassword' => 'Impossible de vous connecter. Veuillez vérifier votre mot de passe.',

    // Forgotten Passwords
    'forgotDisabled' => 'L\'option de réinitialisation du mot de passe a été désactivée.',
    'forgotNoUser' => 'Impossible de trouver un utilisateur avec cet e-mail.',
    'forgotSubject' => 'Instructions de réinitialisation du mot de passe',
    'resetSuccess' => 'Votre mot de passe a été changé avec succès. Veuillez vous connecter avec le nouveau mot de passe.',
    'forgotEmailSent' => 'Un jeton de sécurité vous a été envoyé par e-mail. Entrez-le dans le champ ci-dessous pour continuer.',
    'errorEmailSent' => 'Impossible d\'envoyer l\'e-mail avec les instructions de réinitialisation du mot de passe à : {0}',
    'errorResetting' => 'Impossible d\'envoyer les instructions de réinitialisation à {0}',

    // Passwords
    'errorPasswordLength' => 'Les mots de passe doivent comporter au moins {0, number

} caractères.',
    'suggestPasswordLength' => 'Les phrases de passe - jusqu\'à 255 caractères - permettent de créer des mots de passe plus sécurisés et faciles à retenir.',
    'errorPasswordCommon' => 'Le mot de passe ne doit pas être un mot de passe courant.',
    'suggestPasswordCommon' => 'Le mot de passe a été vérifié par rapport à plus de 65 000 mots de passe couramment utilisés ou divulgués lors de piratages.',
    'errorPasswordPersonal' => 'Les mots de passe ne peuvent pas contenir d\'informations personnelles déjà hachées.',
    'suggestPasswordPersonal' => 'Les variations de votre adresse e-mail ou de votre nom d\'utilisateur ne doivent pas être utilisées comme mots de passe.',
    'errorPasswordTooSimilar' => 'Le mot de passe est trop similaire au nom d\'utilisateur.',
    'suggestPasswordTooSimilar' => 'N\'utilisez pas de parties de votre nom d\'utilisateur dans votre mot de passe.',
    'errorPasswordPwned' => 'Le mot de passe {0} a été exposé lors d\'une violation de données et a été vu {1, number} fois dans {2} mots de passe compromis.',
    'suggestPasswordPwned' => '{0} ne doit jamais être utilisé comme mot de passe. Si vous l\'utilisez quelque part, changez-le immédiatement.',
    'errorPasswordPwnedDatabase' => 'une base de données',
    'errorPasswordPwnedDatabases' => 'des bases de données',
    'errorPasswordEmpty' => 'Un mot de passe est requis.',
    'passwordChangeSuccess' => 'Mot de passe changé avec succès',
    'userDoesNotExist' => 'Le mot de passe n\'a pas été modifié. L\'utilisateur n\'existe pas',
    'resetTokenExpired' => 'Désolé. Votre jeton de réinitialisation a expiré.',

    // Groups
    'groupNotFound' => 'Impossible de trouver le groupe : {0}.',

    // Permissions
    'permissionNotFound' => 'Impossible de trouver l\'autorisation : {0}',

    // Banned
    'userIsBanned' => 'L\'utilisateur a été banni. Contactez l\'administrateur',

    // Too many requests
    'tooManyRequests' => 'Trop de demandes. Veuillez patienter {0, number} secondes.',

    // Login views
    'home' => 'Accueil',
    'current' => 'Actuel',
    'forgotPassword' => 'Mot de passe oublié ?',
    'enterEmailForInstructions' => 'Pas de problème ! Entrez votre adresse e-mail ci-dessous et nous vous enverrons des instructions pour réinitialiser votre mot de passe.',
    'email' => 'E-mail',
    'emailAddress' => 'Adresse e-mail',
    'sendInstructions' => 'Envoyer les instructions',
    'loginTitle' => 'Connexion',
    'loginAction' => 'Connexion',
    'rememberMe' => 'Se souvenir de moi',
    'needAnAccount' => 'Besoin d\'un compte ?',
    'forgotYourPassword' => 'Mot de passe oublié ?',
    'password' => 'Mot de passe',
    'repeatPassword' => 'Répéter le

        mot de passe',
    'emailOrUsername' => 'E-mail ou nom d\'utilisateur',
    'username' => 'Nom d\'utilisateur',
    'register' => 'S\'inscrire',
    'signIn' => 'Se connecter',
    'alreadyRegistered' => 'Déjà inscrit ?',
    'weNeverShare' => 'Nous ne partagerons jamais votre adresse e-mail avec qui que ce soit.',
    'resetYourPassword' => 'Réinitialisez votre mot de passe',
    'enterCodeEmailPassword' => 'Entrez le code que vous avez reçu par e-mail, votre adresse e-mail et votre nouveau mot de passe.',
    'token' => 'Jeton',
    'newPassword' => 'Nouveau mot de passe',
    'repeatPassword' => 'Répéter le nouveau mot de passe',
    'resetPassword' => 'Réinitialiser le mot de passe',
    'lang' => 'Langue',
    'resetPassword' => 'Réinitialiser le mot de passe',
    'lang' => 'Langue',
    'remember' => 'Se souvenir de moi',
    'or' => 'OU',
    'accountDisabled' => 'Votre compte a été désactivé.',
];
