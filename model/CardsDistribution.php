<?php
namespace App\Model;

class CardsDistributionModel extends Model {
    public function createCardsDistribution($players, $pirates, $marins, $siren, $idUser) {
        $query = "INSERT INTO CardsDistribution (players, pirates, marins, siren, idUser) VALUES (:players, :pirates, :marins, :siren, :idUser)";
        return $this->create($query, [
            ':players' => $players,
            ':pirates' => $pirates,
            ':marins' => $marins,
            ':siren' => $siren,
            ':idUser' => $idUser
        ]);
    }

    public function readCardsDistribution($id) {
        $query = "SELECT * FROM CardsDistribution WHERE id = :id";
        return $this->read($query, [':id' => $id]);
    }

    public function updateCardsDistribution($id, $players, $pirates, $marins, $siren) {
        $query = "UPDATE CardsDistribution SET players = :players, pirates = :pirates, marins = :marins, siren = :siren WHERE id = :id";
        return $this->update($query, [
            ':players' => $players,
            ':pirates' => $pirates,
            ':marins' => $marins,
            ':siren' => $siren,
            ':id' => $id
        ]);
    }

    public function deleteCardsDistribution($id) {
        $query = "DELETE FROM CardsDistribution WHERE id = :id";
        return $this->delete($query, [':id' => $id]);
    }

    public function getAllCardsDistribution() {
        $query = "SELECT * FROM CardsDistribution";
        return $this->getAll($query);
    }
}
