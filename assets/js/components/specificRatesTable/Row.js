import React from "react";

const Row = (props) => {
    return (
      <tr key={props.row.index}>
      <td>{props.row.rate.no}</td>
      <td>{props.row.rate.effectiveDate}</td>
      <td>{props.row.rate.mid.toFixed(4)}</td>
    </tr>);
}

export default Row;