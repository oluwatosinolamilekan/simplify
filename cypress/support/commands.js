//Logs in user
//cy.typeLogin({email: '1111@aaa.com' , password: 'aaaaa'})
Cypress.Commands.add('typeLogin' , (user) => {
    cy.get('input[name="email"]').type(user.email);
    cy.get('input[name="password"]').type(user.password);
    cy.get('button[type="submit"]').click();
})

//Log out user
//cy.Logout(user)
Cypress.Commands.add('Logout' , (user) => {
    cy.get('div[id="manage_profile_icon"]').click();
    cy.contains(user.first_name);
    cy.get('a[id="dropdown_logout"]').click();
})

//Empty Mailtrap inbox
//cy.cleanInbox();
Cypress.Commands.add('cleanInbox', ()=> {
    cy.request({
        method: 'PATCH',
        url: 'https://mailtrap.io/api/v1/inboxes/1359199/clean',
        headers: {
            'Api-Token': 'ca853ff71b5987647ca967a75be956b1'
        },
        failOnStatusCode: false

    }).then((res)=> {
        expect(res.status).to.equal(200);
    })
})

//Reach inbox, display mail and click on reset button
//cy.getMail('Some text', user)
Cypress.Commands.add('getMail', (label, user) => {
    cy.request(
        {
            method: 'GET',
            url: 'https://mailtrap.io/api/v1/inboxes/1359199/messages?page=1&last_id=&useremail',
            headers: {
                'Api-Token': 'ca853ff71b5987647ca967a75be956b1'
            },
            failOnStatusCode: false

        }).then((res)=> {
        expect(res.status).to.equal(200);
        expect(res.body[0].subject).to.contains(label)
        expect(res.body[0].to_email).to.contains(user.email);
        cy.request({
            method: 'GET',
            url:   'https://mailtrap.io/'+res.body[0].html_path,
            headers: {
                'Api-Token': 'ca853ff71b5987647ca967a75be956b1'
            },
            failOnStatusCode: false
        }).then((response) => {
            expect(response.status).to.equal(200);
            cy.document().invoke('write', response.body)
            cy.get('a').contains('Reset Password').invoke('removeAttr', 'target').click();
        })
    })
})

//After inputting wrong credentials error message shows and stay on login page
//cy.errorMessageLogin()
Cypress.Commands.add('errorMessageLogin', (label1)=> {
    cy.get('div.font-medium.text-red-600').should('contain','Whoops! Something went wrong.')
    cy.get('ul.mt-3.list-disc.list-inside.text-sm.text-red-600 > li').eq(0).contains(label1);
    cy.location('pathname').should('eq','/login');
})

//Go to Users List page and add new user
//cy.addUser(user)
Cypress.Commands.add('addUser', (user) => {
    cy.get('a[id="sidebar_users_list"]').click();
    cy.get('a[id="add_new_user"]').click();

    cy.get('input[id="first_name"]').type(user.first_name);
    cy.get('input[id="last_name"]').type(user.last_name);
    cy.get('input[id="email"]').type('1'+user.email);
    cy.get('select[id="role"]').select('5').should('have.value', '5');
    cy.get('button[type="submit"]').click();
})

