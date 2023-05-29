function createPricing(quantity)
{
    let pricing = JSON.parse(document.getElementById("price").dataset.pricing);

    let resultingPrice = {set: 0, total: 0};

    for(let i = 0; i < pricing.length; i++)
    {

        if(quantity <= pricing[i].max)
        {
            resultingPrice.set = pricing[i].price;
            resultingPrice.total = pricing[i].price * quantity;
            break;
        }
    }

    return resultingPrice;
}