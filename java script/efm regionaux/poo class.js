// Définition de la classe Véhicule
class Vehicule {
    constructor(marque, modele, prixLocation) {
        this.marque = marque;
        this.modele = modele;
        this.prixLocation = prixLocation;
    }

    afficherDetails() {
        console.log(`Marque: ${this.marque}, Modèle: ${this.modele}, Prix de location: ${this.prixLocation} MAD/jour`);
    }
}

// Définition de la sous-classe Voiture qui hérite de Vehicule
class Voiture extends Vehicule {
    constructor(marque, modele, prixLocation, nombrePortes) {
        super(marque, modele, prixLocation);
        this.nombrePortes = nombrePortes;
    }

    // Surcharge de la méthode afficherDetails
    afficherDetails() {
        console.log(`Marque: ${this.marque}, Modèle: ${this.modele}, Prix de location: ${this.prixLocation} MAD/jour, Nombre de portes: ${this.nombrePortes}`);
    }
}

// Exemple d'utilisation
const vehicule1 = new Vehicule("Toyota", "Corolla", 300);
vehicule1.afficherDetails();

const voiture1 = new Voiture("Honda", "Civic", 350, 4);
voiture1.afficherDetails();
