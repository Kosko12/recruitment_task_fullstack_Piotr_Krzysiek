import React from "react";
import Row from "./Row";
const Body = (props) => {

    return (
        <tbody>
        {props.rates.map(row => {
            return <Row key={row.currency} row={row} />
        })}
        </tbody>
    );
}

export default Body;