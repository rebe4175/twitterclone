
async function resetDb() {

    let request = await fetch("api-delete-database")
    sResponse = await request.text()



}
