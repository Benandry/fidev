<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221111104652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, nom_agence VARCHAR(255) NOT NULL, adress_agence VARCHAR(255) NOT NULL, commune VARCHAR(200) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE approbationcredit (id INT AUTO_INCREMENT NOT NULL, dateap DATE NOT NULL, description VARCHAR(255) NOT NULL, montantapprouver DOUBLE PRECISION NOT NULL, personneap VARCHAR(255) NOT NULL, num_credit VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE approuver_client (id INT AUTO_INCREMENT NOT NULL, codeclient_id INT DEFAULT NULL, dateapprobation DATE NOT NULL, INDEX IDX_387761DCCEAA546A (codeclient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_mobile (id INT AUTO_INCREMENT NOT NULL, code_client VARCHAR(10) NOT NULL, type_client VARCHAR(10) NOT NULL, produit_epargne VARCHAR(100) NOT NULL, actif TINYINT(1) NOT NULL, numero_mobile VARCHAR(50) NOT NULL, code_pin VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, nom_commune VARCHAR(255) NOT NULL, code_commune VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte_epargne (id INT AUTO_INCREMENT NOT NULL, codeclient_id INT DEFAULT NULL, produit_id INT DEFAULT NULL, datedebut DATE NOT NULL, type_client VARCHAR(50) NOT NULL, codeep VARCHAR(50) DEFAULT NULL, codeepargne VARCHAR(30) DEFAULT NULL, INDEX IDX_19FDB51ACEAA546A (codeclient_id), INDEX IDX_19FDB51AF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config_ep (id INT AUTO_INCREMENT NOT NULL, produit_epargne_id INT DEFAULT NULL, deviseutiliser_id INT DEFAULT NULL, is_negatif TINYINT(1) NOT NULL, nbrj_inactif INT NOT NULL, nb_min_ret INT NOT NULL, nbr_jr_max_dep INT NOT NULL, age_min_cpt INT NOT NULL, frais_tenu_cpt DOUBLE PRECISION NOT NULL, commission_ret_cash DOUBLE PRECISION NOT NULL, commission_transf DOUBLE PRECISION NOT NULL, frais_ferm_cpt DOUBLE PRECISION NOT NULL, soldeouvert DOUBLE PRECISION NOT NULL, INDEX IDX_92B49DF24C62D160 (produit_epargne_id), INDEX IDX_92B49DF2A6D70781 (deviseutiliser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depot_aterme (id INT AUTO_INCREMENT NOT NULL, compte_id INT NOT NULL, produit_id INT DEFAULT NULL, datedepot DATETIME NOT NULL, piececomptable VARCHAR(20) NOT NULL, tauxinteret DOUBLE PRECISION NOT NULL, periodemois INT NOT NULL, is_interetcapitalise TINYINT(1) NOT NULL, date_echeance DATETIME NOT NULL, valeurecheance DOUBLE PRECISION NOT NULL, taxeretenue DOUBLE PRECISION NOT NULL, retenuetaxe DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, is_depotcall TINYINT(1) NOT NULL, is_interetecheance TINYINT(1) NOT NULL, is_interetmois TINYINT(1) NOT NULL, is_interettrimestrielle TINYINT(1) NOT NULL, is_interetsemestrielle TINYINT(1) NOT NULL, is_interetpayelorscalcul TINYINT(1) NOT NULL, _is_interettransferercptep TINYINT(1) NOT NULL, is_retirealecheance TINYINT(1) NOT NULL, is_remetreaucptalecheance TINYINT(1) NOT NULL, INDEX IDX_80EAC779F2C56620 (compte_id), INDEX IDX_80EAC779F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devise (id INT AUTO_INCREMENT NOT NULL, devise VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etatcivile (id INT AUTO_INCREMENT NOT NULL, etatcivile VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etude (id INT AUTO_INCREMENT NOT NULL, niveau VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, nom_groupe VARCHAR(255) NOT NULL, date_inscription DATE NOT NULL, numero_mobile VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, codegroupe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE individuelclient (id INT AUTO_INCREMENT NOT NULL, etatcivile_id INT DEFAULT NULL, etude_id INT DEFAULT NULL, titre_id INT DEFAULT NULL, membre_groupe_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nom_client VARCHAR(100) NOT NULL, prenom_client VARCHAR(100) NOT NULL, cin VARCHAR(100) NOT NULL, nom_conjoint VARCHAR(255) NOT NULL, date_inscription DATE NOT NULL, sexe VARCHAR(10) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, numero_mobile VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, nb_enfant INT NOT NULL, nb_personne_charge INT NOT NULL, parent_nom VARCHAR(255) DEFAULT NULL, parent_adresse VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, adressephysique VARCHAR(255) NOT NULL, titre_groupe VARCHAR(255) NOT NULL, lieudelivrance VARCHAR(255) NOT NULL, datecin DATE NOT NULL, dateexpiration DATE NOT NULL, type_identite VARCHAR(255) NOT NULL, dateadhesion DATE DEFAULT NULL, agence VARCHAR(255) NOT NULL, codeclient VARCHAR(30) DEFAULT NULL, commune VARCHAR(255) NOT NULL, INDEX IDX_9B96C69F962FC573 (etatcivile_id), INDEX IDX_9B96C69F47ABD362 (etude_id), INDEX IDX_9B96C69FD54FAE5E (titre_id), INDEX IDX_9B96C69FC5203672 (membre_groupe_id), INDEX IDX_9B96C69FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE individuelclient_compte_epargne (individuelclient_id INT NOT NULL, compte_epargne_id INT NOT NULL, INDEX IDX_8246D5B14C27CDF (individuelclient_id), INDEX IDX_8246D5B2D4E37D3 (compte_epargne_id), PRIMARY KEY(individuelclient_id, compte_epargne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journal_comptabilite (id INT AUTO_INCREMENT NOT NULL, compteepargne VARCHAR(15) NOT NULL, debit INT NOT NULL, credit INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, langue VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_rouge (id INT AUTO_INCREMENT NOT NULL, codegroupe_id INT DEFAULT NULL, codeclient_id INT DEFAULT NULL, dateliste DATE NOT NULL, raison VARCHAR(255) NOT NULL, type_client VARCHAR(120) NOT NULL, INDEX IDX_7CD0B545AD0408C7 (codegroupe_id), INDEX IDX_7CD0B545CEAA546A (codeclient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mobile (id INT AUTO_INCREMENT NOT NULL, code_client_id INT DEFAULT NULL, INDEX IDX_3C7323E0B5AE1119 (code_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_epargne (id INT AUTO_INCREMENT NOT NULL, type_epargne_id INT DEFAULT NULL, nomproduit VARCHAR(255) NOT NULL, isdesactive TINYINT(1) NOT NULL, INDEX IDX_67610235F8593E48 (type_epargne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produittransfert (id INT AUTO_INCREMENT NOT NULL, compte1_id INT DEFAULT NULL, compte2_id INT DEFAULT NULL, datetransfert DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_1991DBC8EDF0C83D (compte1_id), INDEX IDX_1991DBC8FF4567D3 (compte2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivi_client (id INT AUTO_INCREMENT NOT NULL, date_entre DATE NOT NULL, date_sortie DATE NOT NULL, utilisateur VARCHAR(255) NOT NULL, menu_utiliser VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE titre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, piece_comptable VARCHAR(50) NOT NULL, date_transaction DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, papeterie DOUBLE PRECISION NOT NULL, commission DOUBLE PRECISION NOT NULL, type_client VARCHAR(100) NOT NULL, solde VARCHAR(255) DEFAULT NULL, codetransaction INT DEFAULT NULL, codeepargneclient VARCHAR(30) DEFAULT NULL, codeepargnegroupe VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfert_produit (id INT AUTO_INCREMENT NOT NULL, produitatransferer_id INT DEFAULT NULL, produittransmis_id INT DEFAULT NULL, compte_id INT DEFAULT NULL, datetransfert DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_BCF83C4EE4059086 (produitatransferer_id), INDEX IDX_BCF83C4E8E88FB7D (produittransmis_id), INDEX IDX_BCF83C4EF2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfertep (id INT AUTO_INCREMENT NOT NULL, description_t VARCHAR(100) NOT NULL, piece_comptable_t VARCHAR(30) NOT NULL, date_transaction_t DATE NOT NULL, montantdestinataire INT NOT NULL, papeterie INT NOT NULL, commission INT NOT NULL, type_client_t VARCHAR(100) NOT NULL, soldedestinataire VARCHAR(255) DEFAULT NULL, soldeenvoyeur INT NOT NULL, codetransaction_t VARCHAR(255) NOT NULL, codedestinateur VARCHAR(20) NOT NULL, codeenvoyeur VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_epargne (id INT AUTO_INCREMENT NOT NULL, nom_type_ep VARCHAR(255) NOT NULL, abreviation VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, responsabilite VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE approuver_client ADD CONSTRAINT FK_387761DCCEAA546A FOREIGN KEY (codeclient_id) REFERENCES individuelclient (id)');
        $this->addSql('ALTER TABLE compte_epargne ADD CONSTRAINT FK_19FDB51ACEAA546A FOREIGN KEY (codeclient_id) REFERENCES individuelclient (id)');
        $this->addSql('ALTER TABLE compte_epargne ADD CONSTRAINT FK_19FDB51AF347EFB FOREIGN KEY (produit_id) REFERENCES produit_epargne (id)');
        $this->addSql('ALTER TABLE config_ep ADD CONSTRAINT FK_92B49DF24C62D160 FOREIGN KEY (produit_epargne_id) REFERENCES produit_epargne (id)');
        $this->addSql('ALTER TABLE config_ep ADD CONSTRAINT FK_92B49DF2A6D70781 FOREIGN KEY (deviseutiliser_id) REFERENCES devise (id)');
        $this->addSql('ALTER TABLE depot_aterme ADD CONSTRAINT FK_80EAC779F2C56620 FOREIGN KEY (compte_id) REFERENCES individuelclient (id)');
        $this->addSql('ALTER TABLE depot_aterme ADD CONSTRAINT FK_80EAC779F347EFB FOREIGN KEY (produit_id) REFERENCES produit_epargne (id)');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69F962FC573 FOREIGN KEY (etatcivile_id) REFERENCES etatcivile (id)');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69F47ABD362 FOREIGN KEY (etude_id) REFERENCES etude (id)');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69FD54FAE5E FOREIGN KEY (titre_id) REFERENCES titre (id)');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69FC5203672 FOREIGN KEY (membre_groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE individuelclient_compte_epargne ADD CONSTRAINT FK_8246D5B14C27CDF FOREIGN KEY (individuelclient_id) REFERENCES individuelclient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE individuelclient_compte_epargne ADD CONSTRAINT FK_8246D5B2D4E37D3 FOREIGN KEY (compte_epargne_id) REFERENCES compte_epargne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_rouge ADD CONSTRAINT FK_7CD0B545AD0408C7 FOREIGN KEY (codegroupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE liste_rouge ADD CONSTRAINT FK_7CD0B545CEAA546A FOREIGN KEY (codeclient_id) REFERENCES individuelclient (id)');
        $this->addSql('ALTER TABLE mobile ADD CONSTRAINT FK_3C7323E0B5AE1119 FOREIGN KEY (code_client_id) REFERENCES individuelclient (id)');
        $this->addSql('ALTER TABLE produit_epargne ADD CONSTRAINT FK_67610235F8593E48 FOREIGN KEY (type_epargne_id) REFERENCES type_epargne (id)');
        $this->addSql('ALTER TABLE produittransfert ADD CONSTRAINT FK_1991DBC8EDF0C83D FOREIGN KEY (compte1_id) REFERENCES compte_epargne (id)');
        $this->addSql('ALTER TABLE produittransfert ADD CONSTRAINT FK_1991DBC8FF4567D3 FOREIGN KEY (compte2_id) REFERENCES compte_epargne (id)');
        $this->addSql('ALTER TABLE transfert_produit ADD CONSTRAINT FK_BCF83C4EE4059086 FOREIGN KEY (produitatransferer_id) REFERENCES compte_epargne (id)');
        $this->addSql('ALTER TABLE transfert_produit ADD CONSTRAINT FK_BCF83C4E8E88FB7D FOREIGN KEY (produittransmis_id) REFERENCES compte_epargne (id)');
        $this->addSql('ALTER TABLE transfert_produit ADD CONSTRAINT FK_BCF83C4EF2C56620 FOREIGN KEY (compte_id) REFERENCES compte_epargne (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE individuelclient_compte_epargne DROP FOREIGN KEY FK_8246D5B2D4E37D3');
        $this->addSql('ALTER TABLE produittransfert DROP FOREIGN KEY FK_1991DBC8EDF0C83D');
        $this->addSql('ALTER TABLE produittransfert DROP FOREIGN KEY FK_1991DBC8FF4567D3');
        $this->addSql('ALTER TABLE transfert_produit DROP FOREIGN KEY FK_BCF83C4EE4059086');
        $this->addSql('ALTER TABLE transfert_produit DROP FOREIGN KEY FK_BCF83C4E8E88FB7D');
        $this->addSql('ALTER TABLE transfert_produit DROP FOREIGN KEY FK_BCF83C4EF2C56620');
        $this->addSql('ALTER TABLE config_ep DROP FOREIGN KEY FK_92B49DF2A6D70781');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69F962FC573');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69F47ABD362');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69FC5203672');
        $this->addSql('ALTER TABLE liste_rouge DROP FOREIGN KEY FK_7CD0B545AD0408C7');
        $this->addSql('ALTER TABLE approuver_client DROP FOREIGN KEY FK_387761DCCEAA546A');
        $this->addSql('ALTER TABLE compte_epargne DROP FOREIGN KEY FK_19FDB51ACEAA546A');
        $this->addSql('ALTER TABLE depot_aterme DROP FOREIGN KEY FK_80EAC779F2C56620');
        $this->addSql('ALTER TABLE individuelclient_compte_epargne DROP FOREIGN KEY FK_8246D5B14C27CDF');
        $this->addSql('ALTER TABLE liste_rouge DROP FOREIGN KEY FK_7CD0B545CEAA546A');
        $this->addSql('ALTER TABLE mobile DROP FOREIGN KEY FK_3C7323E0B5AE1119');
        $this->addSql('ALTER TABLE compte_epargne DROP FOREIGN KEY FK_19FDB51AF347EFB');
        $this->addSql('ALTER TABLE config_ep DROP FOREIGN KEY FK_92B49DF24C62D160');
        $this->addSql('ALTER TABLE depot_aterme DROP FOREIGN KEY FK_80EAC779F347EFB');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69FD54FAE5E');
        $this->addSql('ALTER TABLE produit_epargne DROP FOREIGN KEY FK_67610235F8593E48');
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69FA76ED395');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE approbationcredit');
        $this->addSql('DROP TABLE approuver_client');
        $this->addSql('DROP TABLE client_mobile');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE compte_epargne');
        $this->addSql('DROP TABLE config_ep');
        $this->addSql('DROP TABLE depot_aterme');
        $this->addSql('DROP TABLE devise');
        $this->addSql('DROP TABLE etatcivile');
        $this->addSql('DROP TABLE etude');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE individuelclient');
        $this->addSql('DROP TABLE individuelclient_compte_epargne');
        $this->addSql('DROP TABLE journal_comptabilite');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE liste_rouge');
        $this->addSql('DROP TABLE mobile');
        $this->addSql('DROP TABLE produit_epargne');
        $this->addSql('DROP TABLE produittransfert');
        $this->addSql('DROP TABLE suivi_client');
        $this->addSql('DROP TABLE titre');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE transfert_produit');
        $this->addSql('DROP TABLE transfertep');
        $this->addSql('DROP TABLE type_epargne');
        $this->addSql('DROP TABLE user');
    }
}
