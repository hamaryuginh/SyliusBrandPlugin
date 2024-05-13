<?php

declare(strict_types=1);

namespace Loevgaard\SyliusBrandPlugin\Model;

class Brand implements BrandInterface
{
    use ProductsAwareTrait {
        ProductsAwareTrait::__construct as private __productsAwareTraitConstruct;
    }
    use ImagesAwareTrait {
        ImagesAwareTrait::__construct as private __imagesAwareTraitConstruct;
    }

    protected ?int $id = null;

    protected ?string $code = null;

    protected ?string $name = null;

    public function __construct()
    {
        $this->__imagesAwareTraitConstruct();
        $this->__productsAwareTraitConstruct();
    }

    public function __toString(): string
    {
        return (string) $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function addProduct(ProductInterface $product): void
    {
        if (!$this->hasProduct($product)) {
            $product->setBrand($this);
            $this->products->add($product);
        }
    }

    public function removeProduct(ProductInterface $product): void
    {
        if ($this->hasProduct($product)) {
            $product->setBrand(null);
            $this->products->removeElement($product);
        }
    }
}
