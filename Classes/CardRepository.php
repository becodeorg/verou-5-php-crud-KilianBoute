<?php

// This class is focussed on dealing with queries for one type of data
// That allows for easier re-using and it's rather easy to find all your queries
// This technique is called the repository pattern
class CardRepository
{
    private DatabaseManager $databaseManager;

    // This class needs a database connection to function
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function create(): void
    {
    }

    // Get one
    public function find(): array
    {
        return [];
    }

    // Get all
    public function get(): array
    {
        // TODO: Create an SQL query
        // TODO: Use your database connection (see $databaseManager) and send your query to your database.
        // TODO: fetch your data at the end of that action.
        // TODO: replace dummy data by real one
        // return [
        //     ['name' => 'dummy one'],
        //     ['name' => 'dummy two'],
        // ];

        $query = "SELECT * FROM cards";

        // We get the database connection first, so we can apply our queries with it
        $result = $this->databaseManager->connection->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(): void
    {
    }

    public function delete($id): void
    {
        $query = "DELETE FROM cards WHERE id=$id";
        $this->databaseManager->connection->query($query);
    }
}
