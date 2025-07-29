import React from "react";

const Row = (props) => {
    return (
    <tr scope="row">
        <td className="border p-2">{props.row.currency}</td>
        <td className="border p-2">{props.row.officialRate.toFixed(4)}</td>
        <td className="border p-2">
          {props.row.buyRate !== null ? props.row.buyRate.toFixed(4) : '—'}
        </td>
        <td className="border p-2">
          {props.row.sellRate !== null ? props.row.sellRate.toFixed(4) : '—'}
        </td>
    </tr>);
}

export default Row;