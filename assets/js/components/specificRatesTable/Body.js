import React from "react";
import Row from "./Row";
const Body = (props) => {

    return (
        <tbody>
          {Object.values(props.rates).map((rate, index) => (
            <Row row={{rate: rate, index: index}} />
          ))}
        </tbody>
    );
}

export default Body;