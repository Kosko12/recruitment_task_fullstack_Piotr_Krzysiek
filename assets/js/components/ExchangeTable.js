import React, { useEffect, useState } from "react";
import Head from "./exchangeTable/Head";
import axios from "axios";
import Body from "./exchangeTable/Body";

const ExchangeTable = () => {
  const [rates, setRates] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios
      .get("http://telemedi-zadanie.localhost/api/check-exchange-rate")
      .then((res) => {
        setRates(() => res.data.data);
        setLoading(false);
      })
      .catch((err) => {
        setLoading(false);
      });
  }, []);

  return (
    <>
      {loading && !rates.length ? (
        <div className={"text-center"}>
          <span className="fa fa-spin fa-spinner fa-4x"></span>
        </div>
      ) : (
        <table className="table">
          <Head />
          <Body rates={rates} />
        </table>
      )}
    </>
  );
};

export default ExchangeTable;
