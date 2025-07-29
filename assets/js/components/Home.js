// ./assets/js/components/Home.js

import React, {Component} from 'react';
import {Route, Redirect, Switch, Link} from 'react-router-dom';
import ExchangeTable from './ExchangeTable';
import SpecificRatesTable from './SpecificRatesTable';

class Home extends Component {

    render() {
        return (
            
            <div>
            
                <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                    <Link className={"navbar-brand"} to={"#"}> Telemedi Zadanko </Link>
                    <div id="navbarText">
                        <ul className="navbar-nav mr-auto">
                            <li className='nav-item'>
                                <Link className={"nav-link"} to={"/check-exchange-rate"}>Check Rates</Link>
                            </li>
                            <li className='nav-item'>
                                <Link className={"nav-link"} to={"/check-exchange-rate-history"}>History Rates</Link>
                            </li>
                        </ul>
                    </div>
                </nav>
                <Switch>
                    {/* <Redirect exact from="/" to="/setup-check" /> */}
                    <Route path="/check-exchange-rate" component={ExchangeTable} />
                    <Route path="/check-exchange-rate-history" component={SpecificRatesTable} />

                </Switch>
            </div>
        )
    }
}

export default Home;
