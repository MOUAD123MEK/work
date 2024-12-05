import re

class Utilisateur:
    def __init__(self, id, email, password, site_web, date_naissance):
        self.id = id
        self.email = email
        self.password = password
        self.site_web = site_web
        self.date_naissance = date_naissance

def saisir_utilisateur():
    utilisateurs = []
    while True:
        id_utilisateur = input("Saisir l'ID de l'utilisateur : ")
        if id_utilisateur == "0":
            break
        email = input("Saisir l'email de l'utilisateur : ")
        password = input("Saisir le mot de passe de l'utilisateur : ")
        site_web = input("Saisir le site web de l'utilisateur : ")
        date_naissance = input("Saisir la date de naissance de l'utilisateur : ")

        if not re.match(r"^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$", email):
            print("Email invalide")
            continue
        if len(password) < 6:
            print("Mot de passe trop court (minimum 6 caractères)")
            continue
        if not re.match(r"^https?://[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$", site_web):
            print("Site web invalide")
            continue
        if not re.match(r"^\d{4}-\d{2}-\d{2}$", date_naissance):
            print("Date de naissance invalide (format YYYY-mm-dd)")
            continue

        utilisateur = Utilisateur(id_utilisateur, email, password, site_web, date_naissance)
        utilisateurs.append(utilisateur)
        print("Utilisateur ajouté avec succès !")

    return utilisateurs

utilisateurs = saisir_utilisateur()
print("Liste des utilisateurs :")
for utilisateur in utilisateurs:
    print(f"ID : {utilisateur.id}, Email : {utilisateur.email}, Site web : {utilisateur.site_web}, Date de naissance : {utilisateur.date_naissance}")