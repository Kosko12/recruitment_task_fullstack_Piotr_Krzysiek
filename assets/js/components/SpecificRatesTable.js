import React, { useEffect, useState } from "react";
import axios from "axios";
import Head from "./specificRatesTable/Head";
import Body from "./specificRatesTable/Body";

const SpecificRatesTable = () => {
  const [rates, setRates] = useState([]);
  const [currency, setCurrency] = useState(['USD']);

  const [loading, setLoading] = useState(true);
  const currencies = ['USD', 'EUR', 'CZK', 'BRL', 'IDR'];


  useEffect(() => {
    const controller = new AbortController();
    axios
      .get(`http://telemedi-zadanie.localhost/api/check-exchange-rate/${currency}/14`, {
        signal: controller.signal
        })
      .then((res) => {
        setRates(() => res.data.data);
        setLoading(false);
        
      })
      .catch((err) => {
        console.error(err);
        setLoading(false);
      });
      return () => {controller.abort()};
  }, [currency]);

  return (
    <>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Options</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01" value={currency}
                    onChange={(e) => setCurrency(e.target.value)}>
                {currencies.map((code) => (
                    <option key={code} value={code}>
                        {code}
                    </option>
                ))}
            </select>
        </div>
    {loading && !rates.length ? (
        <div className={"text-center"}>
          <span className="fa fa-spin fa-spinner fa-4x"></span>
        </div>
      ) : (
      <div className="table-responsive">
      <table className="table table-striped table-bordered">
        <Head />
        <Body rates={rates} />
      </table>
    </div>)}
    </>
  );
};

export default SpecificRatesTable;
