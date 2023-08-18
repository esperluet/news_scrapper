<?php

namespace Esperluet\Repository;

use Esperluet\Domain\News\Model\Article;
use Esperluet\Domain\News\Collection\ArticleCollectionInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ArticleRepository extends ServiceEntityRepository implements ArticleCollectionInterface
{
    private $entityManager; 

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
        $this->entityManager = $this->getEntityManager();
    }

    public function get(string $articleId): ?Article
    {
        return $this->entityManager->getRepository(Article::class)->find($articleId);
    }

    public function save(Article $article)
    {
        $this->entityManager->persist($article);
        $this->entityManager->flush();
    }

    /**
     * @var Article[] $articles
     */
    public function bulkSave(iterable $articles)
    {
        foreach($articles as $article) {
            $this->save($article);
        }
    }

}
