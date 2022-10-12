# Planning

My Plan is to use Docker, Store Products in Entities, use Repositories, SOLID, DRY, PHPUnit, PHPLint, PHPMD, PHPCS, and potentially a Database.

Am I allowed to use:
 - Doctrine and its packages?
 - PHPUnit
 - PHPLint
 - PHPMD
 - PHPCS
 - Mockery

You can use those libs. You should not need Doctrine though. You can just use PHP objects to represent products. No need for a DB.

# Installation


Your job is to implement the basket which should have the following interface:

1. Basket can be initialised with offer(s) user is eligible for
2. It has an add method to add a product
3. Each individual product can only be added to the basket one time
4. It has a total method that returns the total cost of the basket - remember to take into account any valid offers

## There is no need to build any front end components. 
## The interface and behaviours should be validated by the code and its associated automated tests.
